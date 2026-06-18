<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'poster',
        'location',
        'event_date',
        'event_time',
        'category',
        'status',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function issuedTickets(): HasMany
    {
        return $this->hasMany(IssuedTicket::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function minimumPrice(): float
    {
        return (float) $this->tickets->where('status', 'active')->min('price');
    }
}
