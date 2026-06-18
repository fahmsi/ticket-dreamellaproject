@extends('layouts.admin')
@section('title', 'Detail Pelanggan - Dreamella')
@section('admin')
<h1 class="h3">{{ $user->name }}</h1>
<p class="text-muted">{{ $user->email }} - {{ $user->phone }}</p>
<div class="card border-0 shadow-sm"><div class="card-body">
    <h2 class="h5">Riwayat Pembelian</h2>
    <table class="table"><thead><tr><th>Kode</th><th>Event</th><th>Total</th><th>Status</th></tr></thead><tbody>
    @foreach($user->transactions as $transaction)
        <tr><td>{{ $transaction->code }}</td><td>{{ $transaction->event()?->title }}</td><td>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td><td>@include('partials.status', ['status' => $transaction->status])</td></tr>
    @endforeach
    </tbody></table>
</div></div>
@endsection
