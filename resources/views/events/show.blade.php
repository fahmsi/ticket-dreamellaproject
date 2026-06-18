@extends('layouts.app')
@section('title', $event->title.' - Dreamella')
@section('content')
<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-5">
            <div class="event-poster rounded-3 h-100">{{ $event->title }}</div>
        </div>
        <div class="col-lg-7">
            <div class="d-flex gap-2 mb-3">@include('partials.status', ['status' => $event->status]) <span class="badge text-bg-light">{{ $event->category }}</span></div>
            <h1 class="h2">{{ $event->title }}</h1>
            <p class="text-muted">{{ $event->description }}</p>
            <div class="row g-3 mb-4">
                <div class="col-md-6"><div class="p-3 bg-white rounded border"><strong>Tanggal</strong><br>{{ $event->event_date->format('d M Y') }} {{ $event->event_time }}</div></div>
                <div class="col-md-6"><div class="p-3 bg-white rounded border"><strong>Lokasi</strong><br>{{ $event->location }}</div></div>
            </div>
            <h2 class="h5">Pilih Jenis Tiket</h2>
            <div class="vstack gap-3">
                @foreach($event->tickets as $ticket)
                    <form class="card border-0 shadow-sm" method="get" action="{{ route('checkout.show', $event) }}">
                        <div class="card-body row g-3 align-items-center">
                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                            <div class="col-md-5">
                                <div class="fw-bold">{{ $ticket->name }}</div>
                                <div class="small text-muted">{{ $ticket->description }}</div>
                            </div>
                            <div class="col-md-3">
                                <div class="fw-bold">Rp {{ number_format($ticket->price, 0, ',', '.') }}</div>
                                <div class="small text-muted">Stok {{ $ticket->availableSeats() }}</div>
                            </div>
                            <div class="col-md-2">
                                <input class="form-control" type="number" name="quantity" min="1" max="{{ max(1, $ticket->availableSeats()) }}" value="1">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-dream w-100" @disabled($ticket->status !== 'active' || $ticket->availableSeats() < 1)>Beli</button>
                            </div>
                        </div>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
