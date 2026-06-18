@extends('layouts.app')
@section('title', 'Riwayat Transaksi - Dreamella')
@section('content')
<div class="container py-5">
    <h1 class="h3 mb-4">Riwayat Transaksi</h1>
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead><tr><th>Kode</th><th>Event</th><th>Total</th><th>Status</th><th></th></tr></thead>
                <tbody>
                @forelse($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->code }}</td>
                        <td>{{ $transaction->event()?->title }}</td>
                        <td>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                        <td>@include('partials.status', ['status' => $transaction->status])</td>
                        <td class="text-end"><a class="btn btn-sm btn-outline-secondary" href="{{ route('transactions.show', $transaction) }}">Detail</a></td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">Belum ada transaksi.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">{{ $transactions->links() }}</div>
</div>
@endsection
