@extends('layouts.app')
@section('title', 'Detail Transaksi - Dreamella')
@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">{{ $transaction->code }}</h1>
        @include('partials.status', ['status' => $transaction->status])
    </div>
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="h5">Detail Pesanan</h2>
                    <table class="table">
                        <thead><tr><th>Tiket</th><th>Qty</th><th>Harga</th><th>Subtotal</th></tr></thead>
                        <tbody>
                        @foreach($transaction->details as $detail)
                            <tr><td>{{ $detail->ticket->event->title }} - {{ $detail->ticket->name }}</td><td>{{ $detail->quantity }}</td><td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td><td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td></tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-end fw-bold">Total Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="h5">Status Pembayaran</h2>
                    @if($transaction->payment)
                        <div>Metode: {{ $transaction->payment->method?->name }}</div>
                        <div>Pengirim: {{ $transaction->payment->payer_name }}</div>
                        <div>Status: @include('partials.status', ['status' => $transaction->payment->status])</div>
                        @if($transaction->payment->proof_file)<a class="btn btn-sm btn-outline-secondary mt-2" href="{{ route('payments.proof', $transaction->payment) }}" target="_blank">Lihat Bukti</a>@endif
                    @else
                        <p class="text-muted">Belum upload bukti pembayaran.</p>
                    @endif
                    @if(in_array($transaction->status, ['pending_payment','rejected']))
                        <a class="btn btn-dream w-100 mt-3" href="{{ route('transactions.payment', $transaction) }}">Bayar / Upload Ulang</a>
                    @endif
                    @if($transaction->rejected_reason)
                        <div class="alert alert-danger mt-3 mb-0">{{ $transaction->rejected_reason }}</div>
                    @endif
                    @if($transaction->status === 'paid')
                        <a class="btn btn-success w-100 mt-3" href="{{ route('my-tickets.index') }}">Lihat Tiket Saya</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
