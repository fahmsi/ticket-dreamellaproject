@extends('layouts.app')
@section('title', 'Sistem Informasi Pembelian Tiket Online Dreamella Project')
@section('content')
<section class="hero py-5">
    <div class="container py-4">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <h1 class="display-5 fw-bold">Sistem Informasi Pembelian Tiket Online Dreamella Project</h1>
                <p class="lead mt-3">Temukan event, pesan tiket, upload bukti pembayaran manual, dan terima e-ticket setelah diverifikasi admin.</p>
                <a class="btn btn-light btn-lg mt-2" href="{{ route('events.index') }}"><i class="bi bi-calendar-event"></i> Lihat Event</a>
            </div>
            <div class="col-lg-5">
                <div class="p-4 bg-white bg-opacity-10 rounded-3 border border-light border-opacity-25">
                    <div class="h5">Pembayaran manual resmi</div>
                    <div>Transfer bank, e-wallet, atau QRIS Dreamella Project. Tidak menggunakan payment gateway.</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h4 mb-0">Event Aktif</h2>
        <a href="{{ route('events.index') }}">Lihat semua</a>
    </div>
    <div class="row g-4">
        @forelse($events as $event)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="event-poster">{{ $event->title }}</div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between gap-2">@include('partials.status', ['status' => $event->status]) <span class="badge text-bg-light">{{ $event->category }}</span></div>
                        <h3 class="h5 mt-3">{{ $event->title }}</h3>
                        <p class="small text-muted mb-1"><i class="bi bi-calendar"></i> {{ $event->event_date->format('d M Y') }} {{ $event->event_time }}</p>
                        <p class="small text-muted"><i class="bi bi-geo-alt"></i> {{ $event->location }}</p>
                        <div class="fw-bold mb-3">Mulai Rp {{ number_format($event->minimumPrice(), 0, ',', '.') }}</div>
                        <a class="btn btn-dream w-100" href="{{ route('events.show', $event) }}">Detail Event</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12"><div class="alert alert-info">Belum ada event aktif.</div></div>
        @endforelse
    </div>
</section>
@endsection
