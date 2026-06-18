<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'transaction_id',
        'payment_method_id',
        'payer_name',
        'amount',
        'proof_file',
        'status',
        'uploaded_at',
        'verified_by',
        'verified_at',
        'rejected_reason',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'uploaded_at' => 'datetime',
            'verified_at' => 'datetime',
        ];
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function method(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
