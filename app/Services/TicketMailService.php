<?php

namespace App\Services;

use App\Mail\TicketConfirmedMail;
use App\Models\TicketEmailLog;
use App\Models\Transaction;
use Illuminate\Support\Facades\Mail;
use Throwable;

class TicketMailService
{
    public function send(Transaction $transaction): void
    {
        $transaction->loadMissing('user', 'details.ticket.event', 'issuedTickets');

        try {
            Mail::to($transaction->user->email)->send(new TicketConfirmedMail($transaction));

            TicketEmailLog::create([
                'transaction_id' => $transaction->id,
                'user_id' => $transaction->user_id,
                'email' => $transaction->user->email,
                'status' => 'sent',
                'sent_at' => now(),
            ]);
        } catch (Throwable $exception) {
            TicketEmailLog::create([
                'transaction_id' => $transaction->id,
                'user_id' => $transaction->user_id,
                'email' => $transaction->user->email,
                'status' => 'failed',
                'error_message' => $exception->getMessage(),
            ]);
        }
    }
}
