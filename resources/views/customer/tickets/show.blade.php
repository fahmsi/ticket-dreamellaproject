@extends('layouts.app')
@section('title', 'E-Ticket - Dreamella')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card ticket-card shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div><div class="text-danger fw-bold">Dreamella Project</div><h1 class="h3">{{ $ticket->event->title }}</h1></div>
                        @include('partials.status', ['status' => $ticket->status])
                    </div>
                    <div class="row g-4 mt-2 align-items-center">
                        <div class="col-md-7">
                            <dl class="row mb-0">
                                <dt class="col-sm-4">Pemilik</dt><dd class="col-sm-8">{{ $ticket->user->name }}</dd>
                                <dt class="col-sm-4">Jenis</dt><dd class="col-sm-8">{{ $ticket->ticket->name }}</dd>
                                <dt class="col-sm-4">Kode</dt><dd class="col-sm-8 fw-bold">{{ $ticket->ticket_code }}</dd>
                                <dt class="col-sm-4">Tanggal</dt><dd class="col-sm-8">{{ $ticket->event->event_date->format('d M Y') }} {{ $ticket->event->event_time }}</dd>
                                <dt class="col-sm-4">Lokasi</dt><dd class="col-sm-8">{{ $ticket->event->location }}</dd>
                            </dl>
                        </div>
                        <div class="col-md-5 text-center">
                            <img class="img-fluid border rounded" src="{{ route('my-tickets.qr', $ticket->ticket_code) }}" alt="QR tiket">
                        </div>
                    </div>
                    <div class="alert alert-light border mt-4 mb-0">Tunjukkan tiket ini saat masuk event. Tiket hanya bisa digunakan satu kali.</div>
                    <button class="btn btn-outline-secondary mt-3" onclick="window.print()"><i class="bi bi-printer"></i> Cetak Tiket</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
