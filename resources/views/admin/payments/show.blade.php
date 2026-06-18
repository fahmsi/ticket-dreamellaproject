@extends('layouts.admin')
@section('title', 'Detail Pembayaran - Dreamella')
@section('admin')
<h1 class="h3 mb-3">Verifikasi {{ $payment->transaction->code }}</h1>
<div class="row g-4">
    <div class="col-lg-7"><div class="card border-0 shadow-sm"><div class="card-body">
        <h2 class="h5">Detail</h2>
        <p><strong>Pelanggan:</strong> {{ $payment->transaction->user->name }}</p>
        <p><strong>Metode:</strong> {{ $payment->method?->name }} | <strong>Pengirim:</strong> {{ $payment->payer_name }}</p>
        <p><strong>Total:</strong> Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
        <a class="btn btn-outline-secondary" href="{{ route('payments.proof', $payment) }}" target="_blank">Buka Bukti Pembayaran</a>
    </div></div></div>
    <div class="col-lg-5"><div class="card border-0 shadow-sm"><div class="card-body">
        <form method="post" action="{{ route('admin.payments.verify', $payment) }}" class="mb-3">@csrf<button class="btn btn-success w-100" onclick="return confirm('Terima pembayaran ini?')">Verifikasi / Terima Pembayaran</button></form>
        <form method="post" action="{{ route('admin.payments.reject', $payment) }}">
            @csrf
            <label class="form-label">Alasan Penolakan</label>
            <textarea class="form-control mb-2" name="reason" required></textarea>
            <button class="btn btn-outline-danger w-100">Tolak Pembayaran</button>
        </form>
    </div></div></div>
</div>
@endsection
