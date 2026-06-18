<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'code',
        'total_amount',
        'status',
        'payment_deadline',
        'paid_at',
        'verified_at',
        'rejected_reason',
    ];

    protected function casts(): array
    {
        return [
            'total_amount' => 'decimal:2',
            'payment_deadline' => 'datetime',
            'paid_at' => 'datetime',
            'verified_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function issuedTickets(): HasMany
    {
        return $this->hasMany(IssuedTicket::class);
    }

    public function event(): ?Event
    {
        return $this->details->first()?->ticket?->event;
    }
}
