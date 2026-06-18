@extends('layouts.app')
@section('title', 'Tiket Saya - Dreamella')
@section('content')
<div class="container py-5">
    <h1 class="h3 mb-4">Tiket Saya</h1>
    <div class="row g-4">
        @forelse($tickets as $ticket)
            <div class="col-md-6 col-lg-4">
                <div class="card ticket-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">@include('partials.status', ['status' => $ticket->status]) <span class="small text-muted">{{ $ticket->ticket->name }}</span></div>
                        <h2 class="h5 mt-3">{{ $ticket->event->title }}</h2>
                        <p class="small text-muted mb-2">{{ $ticket->event->event_date->format('d M Y') }} - {{ $ticket->event->location }}</p>
                        <div class="fw-bold small">{{ $ticket->ticket_code }}</div>
                        <a class="btn btn-dream w-100 mt-3" href="{{ route('my-tickets.show', $ticket->ticket_code) }}">Lihat Tiket</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12"><div class="alert alert-info">Tiket akan muncul setelah pembayaran diverifikasi admin.</div></div>
        @endforelse
    </div>
    <div class="mt-3">{{ $tickets->links() }}</div>
</div>
@endsection
