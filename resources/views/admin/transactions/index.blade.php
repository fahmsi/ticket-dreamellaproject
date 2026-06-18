@extends('layouts.admin')
@section('title', 'Data Transaksi - Dreamella')
@section('admin')
<h1 class="h3 mb-3">Data Transaksi</h1>
<form class="row g-2 mb-3" method="get">
    <div class="col-md-3"><select class="form-select" name="status"><option value="">Semua status</option>@foreach(['pending_payment','waiting_verification','paid','rejected','cancelled','expired'] as $status)<option value="{{ $status }}" @selected(request('status')===$status)>{{ $status }}</option>@endforeach</select></div>
    <div class="col-md-3"><select class="form-select" name="event_id"><option value="">Semua event</option>@foreach($events as $event)<option value="{{ $event->id }}" @selected(request('event_id')==$event->id)>{{ $event->title }}</option>@endforeach</select></div>
    <div class="col-md-3"><input class="form-control" type="date" name="date" value="{{ request('date') }}"></div>
    <div class="col-md-3"><button class="btn btn-outline-secondary w-100">Filter</button></div>
</form>
<div class="card border-0 shadow-sm"><div class="table-responsive">
    <table class="table mb-0"><thead><tr><th>Kode</th><th>Pelanggan</th><th>Event</th><th>Total</th><th>Status</th><th></th></tr></thead><tbody>
    @foreach($transactions as $transaction)
        <tr><td>{{ $transaction->code }}</td><td>{{ $transaction->user->name }}</td><td>{{ $transaction->event()?->title }}</td><td>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td><td>@include('partials.status', ['status' => $transaction->status])</td><td class="text-end"><a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.transactions.show', $transaction) }}">Detail</a></td></tr>
    @endforeach
    </tbody></table>
</div></div>
<div class="mt-3">{{ $transactions->links() }}</div>
@endsection
