<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\Transaction;

class TransactionExpiryService
{
    public function expireOverduePending(): int
    {
        $transactions = Transaction::query()
            ->where('status', 'pending_payment')
            ->whereNotNull('payment_deadline')
            ->where('payment_deadline', '<', now())
            ->with('payment')
            ->get();

        foreach ($transactions as $transaction) {
            $transaction->update(['status' => 'expired']);

            if ($transaction->payment?->status === 'pending') {
                $transaction->payment->update(['status' => 'rejected']);
            }
        }

        return $transactions->count();
    }
}
