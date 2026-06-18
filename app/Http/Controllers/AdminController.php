<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\IssuedTicket;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\User;
use App\Services\PaymentVerificationService;
use App\Services\TicketMailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $paidTransactions = Transaction::with('details.ticket.event')
            ->where('status', 'paid')
            ->get();

        $salesByEvent = $paidTransactions
            ->flatMap->details
            ->groupBy(fn ($detail) => $detail->ticket->event->title)
            ->map(fn ($details) => [
                'tickets' => $details->sum('quantity'),
                'revenue' => $details->sum('subtotal'),
            ])
            ->sortByDesc('revenue');

        $stats = [
            'events' => Event::count(),
            'transactions' => Transaction::count(),
            'tickets_sold' => IssuedTicket::where('status', 'active')->count(),
            'revenue' => $paidTransactions->sum('total_amount'),
            'waiting' => Transaction::where('status', 'waiting_verification')->count(),
        ];

        $latestTransactions = Transaction::with('user', 'details.ticket.event', 'payment')
            ->latest()
            ->take(8)
            ->get();

        return view('admin.dashboard', compact('stats', 'latestTransactions', 'salesByEvent'));
    }

    public function events(Request $request)
    {
        $events = Event::withCount('tickets')
            ->when($request->filled('q'), fn ($query) => $query->where('title', 'like', '%'.$request->q.'%'))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.events.index', compact('events'));
    }

    public function createEvent()
    {
        return view('admin.events.form', ['event' => new Event()]);
    }

    public function storeEvent(Request $request)
    {
        $data = $this->eventData($request);
        $data['slug'] = Str::slug($data['title']).'-'.Str::lower(Str::random(4));
        $data['created_by'] = $request->user()->id;

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        Event::create($data);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dibuat.');
    }

    public function editEvent(Event $event)
    {
        return view('admin.events.form', compact('event'));
    }

    public function updateEvent(Request $request, Event $event)
    {
        $data = $this->eventData($request);

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $event->update($data);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui.');
    }

    public function destroyEvent(Event $event)
    {
        $event->delete();

        return back()->with('success', 'Event dihapus.');
    }

    public function eventTickets(Event $event)
    {
        $event->load('tickets');

        return view('admin.tickets.index', compact('event'));
    }

    public function storeTicket(Request $request, Event $event)
    {
        $event->tickets()->create($this->ticketData($request));

        return back()->with('success', 'Jenis tiket ditambahkan.');
    }

    public function editTicket(Ticket $ticket)
    {
        $ticket->load('event');

        return view('admin.tickets.form', compact('ticket'));
    }

    public function updateTicket(Request $request, Ticket $ticket)
    {
        $ticket->update($this->ticketData($request));

        return redirect()->route('admin.events.tickets', $ticket->event)->with('success', 'Tiket diperbarui.');
    }

    public function destroyTicket(Ticket $ticket)
    {
        $ticket->delete();

        return back()->with('success', 'Tiket dihapus.');
    }

    public function customers(Request $request)
    {
        $customers = User::where('role', 'customer')
            ->withCount('transactions')
            ->when($request->filled('q'), fn ($query) => $query->where('name', 'like', '%'.$request->q.'%')->orWhere('email', 'like', '%'.$request->q.'%'))
            ->paginate(10)
            ->withQueryString();

        return view('admin.customers.index', compact('customers'));
    }

    public function showCustomer(User $user)
    {
        abort_unless($user->role === 'customer', 404);
        $user->load('transactions.details.ticket.event', 'transactions.payment');

        return view('admin.customers.show', compact('user'));
    }

    public function transactions(Request $request)
    {
        $transactions = Transaction::with('user', 'details.ticket.event', 'payment')
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status))
            ->when($request->filled('date'), fn ($query) => $query->whereDate('created_at', $request->date))
            ->when($request->filled('event_id'), fn ($query) => $query->whereHas('details.ticket', fn ($q) => $q->where('event_id', $request->event_id)))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $events = Event::orderBy('title')->get();

        return view('admin.transactions.index', compact('transactions', 'events'));
    }

    public function showTransaction(Transaction $transaction)
    {
        $transaction->load('user', 'details.ticket.event', 'payment.method', 'issuedTickets');

        return view('admin.transactions.show', compact('transaction'));
    }

    public function payments()
    {
        $payments = Payment::with('transaction.user', 'transaction.details.ticket.event', 'method')
            ->where('status', 'uploaded')
            ->latest('uploaded_at')
            ->paginate(12);

        return view('admin.payments.index', compact('payments'));
    }

    public function showPayment(Payment $payment)
    {
        $payment->load('transaction.user', 'transaction.details.ticket.event', 'method');

        return view('admin.payments.show', compact('payment'));
    }

    public function verifyPayment(Payment $payment, PaymentVerificationService $service)
    {
        $service->verify($payment, auth()->id());

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran diterima dan tiket diterbitkan.');
    }

    public function rejectPayment(Request $request, Payment $payment, PaymentVerificationService $service)
    {
        $data = $request->validate(['reason' => ['required', 'string', 'max:1000']]);
        $service->reject($payment, $data['reason'], auth()->id());

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran ditolak.');
    }

    public function resendTicket(Transaction $transaction, TicketMailService $mailService)
    {
        abort_unless($transaction->status === 'paid', 422);
        $mailService->send($transaction);

        return back()->with('success', 'Email tiket dikirim ulang.');
    }

    public function reports(Request $request)
    {
        $paid = Transaction::with('details.ticket.event')
            ->where('status', 'paid')
            ->when($request->filled('from'), fn ($query) => $query->whereDate('paid_at', '>=', $request->from))
            ->when($request->filled('to'), fn ($query) => $query->whereDate('paid_at', '<=', $request->to))
            ->when($request->filled('event_id'), fn ($query) => $query->whereHas('details.ticket', fn ($q) => $q->where('event_id', $request->event_id)))
            ->when($request->filled('ticket_id'), fn ($query) => $query->whereHas('details', fn ($q) => $q->where('ticket_id', $request->ticket_id)));

        $transactions = (clone $paid)->latest('paid_at')->paginate(20)->withQueryString();
        $transactions->getCollection()->transform(function (Transaction $transaction) use ($request) {
            $details = $this->filteredReportDetails($transaction, $request);

            $transaction->setAttribute('report_tickets', $details->sum('quantity'));
            $transaction->setAttribute('report_amount', $details->sum('subtotal'));

            return $transaction;
        });

        $summarySource = (clone $paid)->get();
        $summaryDetails = $summarySource->flatMap(fn (Transaction $transaction) => $this->filteredReportDetails($transaction, $request));

        $summary = [
            'transactions' => $summarySource->count(),
            'revenue' => $summaryDetails->sum('subtotal'),
            'tickets' => $summaryDetails->sum('quantity'),
        ];
        $events = Event::orderBy('title')->get();
        $tickets = Ticket::with('event')->orderBy('name')->get();

        return view('admin.reports.sales', compact('transactions', 'summary', 'events', 'tickets'));
    }

    public function exportReports(Request $request)
    {
        $rows = Transaction::with('user', 'details.ticket.event')
            ->where('status', 'paid')
            ->when($request->filled('from'), fn ($query) => $query->whereDate('paid_at', '>=', $request->from))
            ->when($request->filled('to'), fn ($query) => $query->whereDate('paid_at', '<=', $request->to))
            ->when($request->filled('event_id'), fn ($query) => $query->whereHas('details.ticket', fn ($q) => $q->where('event_id', $request->event_id)))
            ->when($request->filled('ticket_id'), fn ($query) => $query->whereHas('details', fn ($q) => $q->where('ticket_id', $request->ticket_id)))
            ->get();

        $csv = "Kode,Nama Customer,Event,Jenis Tiket,Jumlah Tiket,Total Filter,Status,Tanggal Bayar\n";
        foreach ($rows as $transaction) {
            $details = $this->filteredReportDetails($transaction, $request);
            $event = $details->pluck('ticket.event.title')->filter()->unique()->implode(' | ');
            $ticketNames = $details->pluck('ticket.name')->filter()->unique()->implode(' | ');

            $csv .= implode(',', [
                $transaction->code,
                $transaction->user->name,
                $this->csvValue($event),
                $this->csvValue($ticketNames),
                $details->sum('quantity'),
                $details->sum('subtotal'),
                $transaction->status,
                optional($transaction->paid_at)->format('Y-m-d H:i:s'),
            ])."\n";
        }

        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="laporan-penjualan.csv"',
        ]);
    }

    public function paymentMethods()
    {
        $methods = PaymentMethod::latest()->paginate(10);

        return view('admin.payment-methods.index', compact('methods'));
    }

    public function storePaymentMethod(Request $request)
    {
        $data = $this->paymentMethodData($request);

        if ($request->hasFile('qris_image')) {
            $data['qris_image'] = $request->file('qris_image')->store('qris', 'public');
        }

        PaymentMethod::create($data);

        return back()->with('success', 'Metode pembayaran ditambahkan.');
    }

    public function updatePaymentMethod(Request $request, PaymentMethod $paymentMethod)
    {
        $data = $this->paymentMethodData($request);

        if ($request->hasFile('qris_image')) {
            $data['qris_image'] = $request->file('qris_image')->store('qris', 'public');
        }

        $paymentMethod->update($data);

        return back()->with('success', 'Metode pembayaran diperbarui.');
    }

    public function destroyPaymentMethod(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();

        return back()->with('success', 'Metode pembayaran dihapus.');
    }

    public function checkIn(Request $request)
    {
        $ticket = null;
        if ($request->filled('code')) {
            $ticket = IssuedTicket::with('event', 'ticket', 'user')->where('ticket_code', $request->code)->first();
        }

        return view('admin.check-in.index', compact('ticket'));
    }

    public function validateTicket(Request $request)
    {
        $data = $request->validate(['code' => ['required', 'string']]);

        return redirect()->route('admin.check-in.index', ['code' => $data['code']]);
    }

    public function markUsed(IssuedTicket $issuedTicket)
    {
        abort_if($issuedTicket->status !== 'active', 422, 'Tiket tidak aktif.');

        $issuedTicket->update([
            'status' => 'used',
            'checked_in_at' => now(),
            'checked_in_by' => auth()->id(),
        ]);

        return back()->with('success', 'Tiket berhasil ditandai check-in.');
    }

    private function eventData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'poster' => ['nullable', 'image', 'max:2048'],
            'location' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'event_time' => ['nullable'],
            'category' => ['nullable', 'string', 'max:100'],
            'status' => ['required', 'in:draft,published,closed'],
        ]);
    }

    private function ticketData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'quota' => ['required', 'integer', 'min:1'],
            'sale_start_at' => ['nullable', 'date'],
            'sale_end_at' => ['nullable', 'date'],
            'status' => ['required', 'in:active,inactive'],
        ]);
    }

    private function paymentMethodData(Request $request): array
    {
        return $request->validate([
            'type' => ['required', 'in:bank,ewallet,qris'],
            'name' => ['required', 'string', 'max:255'],
            'account_name' => ['required', 'string', 'max:255'],
            'account_number' => ['nullable', 'string', 'max:255'],
            'qris_image' => ['nullable', 'image', 'max:2048'],
            'instructions' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]) + ['is_active' => false];
    }

    private function filteredReportDetails(Transaction $transaction, Request $request)
    {
        return $transaction->details
            ->when($request->filled('event_id'), fn ($details) => $details->where('ticket.event_id', (int) $request->event_id))
            ->when($request->filled('ticket_id'), fn ($details) => $details->where('ticket_id', (int) $request->ticket_id))
            ->values();
    }

    private function csvValue(?string $value): string
    {
        $value ??= '';

        return '"'.str_replace('"', '""', $value).'"';
    }
}
