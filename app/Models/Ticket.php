<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'description',
        'price',
        'quota',
        'sold_count',
        'sale_start_at',
        'sale_end_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'sale_start_at' => 'datetime',
            'sale_end_at' => 'datetime',
        ];
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function transactionDetails(): HasMany
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function availableSeats(): int
    {
        return max(0, $this->quota - $this->sold_count);
    }

    public function isSaleable(): bool
    {
        $now = now();

        return $this->status === 'active'
            && $this->event?->status === 'published'
            && $this->availableSeats() > 0
            && (!$this->sale_start_at || $this->sale_start_at->lte($now))
            && (!$this->sale_end_at || $this->sale_end_at->gte($now));
    }
}
