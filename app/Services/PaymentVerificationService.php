<?php

namespace App\Services;

use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PaymentVerificationService
{
    public function __construct(
        private readonly TicketIssuingService $ticketIssuingService,
        private readonly TicketMailService $ticketMailService,
    ) {
    }

    public function verify(Payment $payment, int $adminId): void
    {
        $transaction = DB::transaction(function () use ($payment, $adminId) {
            $payment = Payment::with('transaction.details.ticket.event')
                ->whereKey($payment->id)
                ->lockForUpdate()
                ->firstOrFail();

            $transaction = $payment->transaction;

            if ($transaction->status === 'paid') {
                return $transaction;
            }

            foreach ($transaction->details as $detail) {
                $ticket = $detail->ticket()->lockForUpdate()->first();

                if ($ticket->availableSeats() < $detail->quantity) {
                    throw ValidationException::withMessages([
                        'payment' => 'Stok tiket '.$ticket->name.' tidak cukup untuk diverifikasi.',
                    ]);
                }
            }

            $payment->update([
                'status' => 'verified',
                'verified_by' => $adminId,
                'verified_at' => now(),
                'rejected_reason' => null,
            ]);

            $transaction->update([
                'status' => 'paid',
                'paid_at' => now(),
                'verified_at' => now(),
                'rejected_reason' => null,
            ]);

            foreach ($transaction->details as $detail) {
                $detail->ticket()->increment('sold_count', $detail->quantity);
            }

            $this->ticketIssuingService->issueFor($transaction);

            return $transaction->fresh(['user', 'details.ticket.event', 'issuedTickets']);
        });

        $this->ticketMailService->send($transaction);
    }

    public function reject(Payment $payment, string $reason, int $adminId): void
    {
        DB::transaction(function () use ($payment, $reason, $adminId) {
            $payment = Payment::with('transaction')->whereKey($payment->id)->lockForUpdate()->firstOrFail();

            $payment->update([
                'status' => 'rejected',
                'verified_by' => $adminId,
                'verified_at' => now(),
                'rejected_reason' => $reason,
            ]);

            $payment->transaction->update([
                'status' => 'rejected',
                'rejected_reason' => $reason,
            ]);
        });
    }
}
