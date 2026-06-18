@extends('layouts.app')
@section('title', 'Checkout - Dreamella')
@section('content')
<div class="container py-5">
    <div class="mb-4">
        <div class="progress" style="height: 8px"><div class="progress-bar bg-danger" style="width: 20%"></div></div>
        <div class="d-flex justify-content-between small mt-2 text-muted"><span>Pilih Tiket</span><span>Pembayaran</span><span>Upload Bukti</span><span>Verifikasi</span><span>Tiket Terbit</span></div>
    </div>
    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h1 class="h4">Ringkasan Pesanan</h1>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Event</dt><dd class="col-sm-8">{{ $event->title }}</dd>
                        <dt class="col-sm-4">Tanggal</dt><dd class="col-sm-8">{{ $event->event_date->format('d M Y') }} {{ $event->event_time }}</dd>
                        <dt class="col-sm-4">Lokasi</dt><dd class="col-sm-8">{{ $event->location }}</dd>
                        <dt class="col-sm-4">Jenis Tiket</dt><dd class="col-sm-8">{{ $ticket->name }}</dd>
                        <dt class="col-sm-4">Jumlah</dt><dd class="col-sm-8">{{ $quantity }}</dd>
                        <dt class="col-sm-4">Harga</dt><dd class="col-sm-8">Rp {{ number_format($ticket->price, 0, ',', '.') }}</dd>
                        <dt class="col-sm-4">Total</dt><dd class="col-sm-8 fw-bold">Rp {{ number_format($ticket->price * $quantity, 0, ',', '.') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form method="post" action="{{ route('checkout.store') }}">
                        @csrf
                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                        <input type="hidden" name="quantity" value="{{ $quantity }}">
                        <button class="btn btn-dream btn-lg w-100"><i class="bi bi-receipt"></i> Konfirmasi Pesanan</button>
                    </form>
                    <p class="small text-muted mt-3 mb-0">Transaksi dibuat sebagai pending payment. Stok tiket akan dihitung terjual setelah pembayaran diverifikasi admin.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
