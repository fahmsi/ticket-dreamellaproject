@extends('layouts.admin')
@section('title', 'Admin Dashboard - Dreamella')
@section('admin')
<h1 class="h3 mb-4">Dashboard</h1>
<div class="row g-3 mb-4">
    @foreach([
        'Total Event' => $stats['events'],
        'Total Transaksi' => $stats['transactions'],
        'Tiket Terjual' => $stats['tickets_sold'],
        'Pendapatan' => 'Rp '.number_format($stats['revenue'], 0, ',', '.'),
        'Menunggu Verifikasi' => $stats['waiting'],
    ] as $label => $value)
        <div class="col-md"><div class="card border-0 shadow-sm"><div class="card-body"><div class="small text-muted">{{ $label }}</div><div class="h4 mb-0">{{ $value }}</div></div></div></div>
    @endforeach
</div>
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h2 class="h5">Transaksi Terbaru</h2>
        <div class="table-responsive">
            <table class="table">
                <thead><tr><th>Kode</th><th>Pelanggan</th><th>Event</th><th>Total</th><th>Status</th></tr></thead>
                <tbody>
                @foreach($latestTransactions as $transaction)
                    <tr><td>{{ $transaction->code }}</td><td>{{ $transaction->user->name }}</td><td>{{ $transaction->event()?->title }}</td><td>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td><td>@include('partials.status', ['status' => $transaction->status])</td></tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
