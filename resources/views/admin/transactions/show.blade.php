@extends('layouts.admin')
@section('title', 'Detail Transaksi Admin - Dreamella')
@section('admin')
<div class="d-flex justify-content-between align-items-center mb-3"><h1 class="h3 mb-0">{{ $transaction->code }}</h1>@include('partials.status', ['status' => $transaction->status])</div>
<div class="row g-4">
    <div class="col-lg-8"><div class="card border-0 shadow-sm"><div class="card-body">
        <p><strong>Pelanggan:</strong> {{ $transaction->user->name }} ({{ $transaction->user->email }})</p>
        <table class="table"><thead><tr><th>Event/Tiket</th><th>Qty</th><th>Subtotal</th></tr></thead><tbody>
        @foreach($transaction->details as $detail)<tr><td>{{ $detail->ticket->event->title }} - {{ $detail->ticket->name }}</td><td>{{ $detail->quantity }}</td><td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td></tr>@endforeach
        </tbody></table>
        <div class="fw-bold text-end">Total Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</div>
    </div></div></div>
    <div class="col-lg-4"><div class="card border-0 shadow-sm"><div class="card-body">
        <h2 class="h5">Pembayaran</h2>
        @if($transaction->payment)
            <p>{{ $transaction->payment->method?->name }} - @include('partials.status', ['status' => $transaction->payment->status])</p>
            @if($transaction->payment->proof_file)<a class="btn btn-outline-secondary w-100" target="_blank" href="{{ route('payments.proof', $transaction->payment) }}">Lihat Bukti</a>@endif
        @else <p class="text-muted">Belum ada bukti pembayaran.</p>@endif
        @if($transaction->status === 'paid')
            <form method="post" action="{{ route('admin.transactions.resend-ticket', $transaction) }}" class="mt-3">@csrf<button class="btn btn-success w-100">Kirim Ulang Tiket</button></form>
        @endif
    </div></div></div>
</div>
@endsection
