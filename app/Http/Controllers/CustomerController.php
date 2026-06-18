<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\IssuedTicket;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Ticket;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function checkout(Event $event, Request $request)
    {
        $ticket = Ticket::with('event')->where('event_id', $event->id)->findOrFail($request->integer('ticket_id'));
        $quantity = max(1, min(10, $request->integer('quantity', 1)));

        abort_unless($ticket->isSaleable() && $ticket->availableSeats() >= $quantity, 422, 'Tiket tidak tersedia.');

        return view('customer.checkout', compact('event', 'ticket', 'quantity'));
    }

    public function storeCheckout(Request $request)
    {
        $data = $request->validate([
            'ticket_id' => ['required', 'exists:tickets,id'],
            'quantity' => ['required', 'integer', 'min:1', 'max:10'],
        ]);

        $ticket = Ticket::with('event')->findOrFail($data['ticket_id']);

        if (!$ticket->isSaleable() || $ticket->availableSeats() < $data['quantity']) {
            return back()->withErrors(['quantity' => 'Stok tiket tidak cukup atau penjualan sudah ditutup.']);
        }

        $transaction = DB::transaction(function () use ($request, $ticket, $data) {
            $quantity = (int) $data['quantity'];
            $subtotal = $ticket->price * $quantity;

            $transaction = Transaction::create([
                'user_id' => $request->user()->id,
                'code' => 'TRX-'.now()->format('YmdHis').'-'.Str::upper(Str::random(5)),
                'total_amount' => $subtotal,
                'status' => 'pending_payment',
                'payment_deadline' => now()->addDay(),
            ]);

            $transaction->details()->create([
                'ticket_id' => $ticket->id,
                'quantity' => $quantity,
                'price' => $ticket->price,
                'subtotal' => $subtotal,
            ]);

            return $transaction;
        });

        return redirect()->route('transactions.payment', $transaction)->with('success', 'Transaksi dibuat. Silakan pilih metode pembayaran.');
    }

    public function transactions(Request $request)
    {
        $transactions = $request->user()->transactions()
            ->with('details.ticket.event', 'payment.method', 'issuedTickets')
            ->latest()
            ->paginate(10);

        return view('customer.transactions.index', compact('transactions'));
    }

    public function showTransaction(Request $request, Transaction $transaction)
    {
        $this->authorizeOwner($request, $transaction);
        $transaction->load('details.ticket.event', 'payment.method', 'issuedTickets');

        return view('customer.transactions.show', compact('transaction'));
    }

    public function payment(Request $request, Transaction $transaction)
    {
        $this->authorizeOwner($request, $transaction);
        $transaction->load('details.ticket.event', 'payment.method');
        $methods = PaymentMethod::where('is_active', true)->orderBy('type')->get();

        return view('customer.payment', compact('transaction', 'methods'));
    }

    public function uploadPayment(Request $request, Transaction $transaction)
    {
        $this->authorizeOwner($request, $transaction);

        if (!in_array($transaction->status, ['pending_payment', 'rejected'], true)) {
            return back()->withErrors(['proof_file' => 'Bukti hanya bisa diunggah saat transaksi pending atau ditolak.']);
        }

        $data = $request->validate([
            'payment_method_id' => ['required', 'exists:payment_methods,id'],
            'payer_name' => ['required', 'string', 'max:255'],
            'proof_file' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ]);

        $path = $request->file('proof_file')->store('payment-proofs', 'local');

        Payment::updateOrCreate(
            ['transaction_id' => $transaction->id],
            [
                'payment_method_id' => $data['payment_method_id'],
                'payer_name' => $data['payer_name'],
                'amount' => $transaction->total_amount,
                'proof_file' => $path,
                'status' => 'uploaded',
                'uploaded_at' => now(),
                'rejected_reason' => null,
            ],
        );

        $transaction->update([
            'status' => 'waiting_verification',
            'rejected_reason' => null,
        ]);

        return redirect()->route('transactions.show', $transaction)->with('success', 'Bukti pembayaran dikirim. Menunggu verifikasi admin.');
    }

    public function myTickets(Request $request)
    {
        $tickets = IssuedTicket::with('event', 'ticket', 'transaction')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(12);

        return view('customer.tickets.index', compact('tickets'));
    }

    public function showTicket(Request $request, string $ticketCode)
    {
        $ticket = IssuedTicket::with('event', 'ticket', 'transaction', 'user')
            ->where('ticket_code', $ticketCode)
            ->firstOrFail();

        abort_unless($ticket->user_id === $request->user()->id || $request->user()->isAdmin(), 403);

        return view('customer.tickets.show', compact('ticket'));
    }

    public function ticketQr(Request $request, string $ticketCode)
    {
        $ticket = IssuedTicket::where('ticket_code', $ticketCode)->firstOrFail();
        abort_unless($ticket->user_id === $request->user()->id || $request->user()->isAdmin(), 403);

        return Storage::disk('local')->response($ticket->qr_code_path);
    }

    public function profile(Request $request)
    {
        return view('customer.profile', ['user' => $request->user()]);
    }

    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'avatar' => ['nullable', 'image', 'max:1024'],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $request->user()->update($data);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function paymentProof(Request $request, Payment $payment)
    {
        $payment->load('transaction');
        abort_unless($request->user()->isAdmin() || $payment->transaction->user_id === $request->user()->id, 403);

        return Storage::disk('local')->response($payment->proof_file);
    }

    private function authorizeOwner(Request $request, Transaction $transaction): void
    {
        abort_unless($transaction->user_id === $request->user()->id || $request->user()->isAdmin(), 403);
    }
}
