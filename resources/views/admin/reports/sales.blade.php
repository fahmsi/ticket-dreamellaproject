@extends('layouts.admin')
@section('title', 'Laporan Penjualan - Dreamella')
@section('admin')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Laporan Penjualan</h1>
    <a class="btn btn-outline-success" href="{{ route('admin.reports.sales.export', request()->query()) }}"><i class="bi bi-download"></i> Export CSV</a>
</div>
<form class="row g-2 mb-3" method="get">
    <div class="col-md-2"><input class="form-control" type="date" name="from" value="{{ request('from') }}"></div>
    <div class="col-md-2"><input class="form-control" type="date" name="to" value="{{ request('to') }}"></div>
    <div class="col-md-3"><select class="form-select" name="event_id"><option value="">Semua event</option>@foreach($events as $event)<option value="{{ $event->id }}" @selected(request('event_id')==$event->id)>{{ $event->title }}</option>@endforeach</select></div>
    <div class="col-md-3"><select class="form-select" name="ticket_id"><option value="">Semua jenis tiket</option>@foreach($tickets as $ticket)<option value="{{ $ticket->id }}" @selected(request('ticket_id')==$ticket->id)>{{ $ticket->event->title }} - {{ $ticket->name }}</option>@endforeach</select></div>
    <div class="col-md-2"><button class="btn btn-outline-secondary w-100">Filter</button></div>
</form>
<div class="row g-3 mb-4">
    <div class="col-md-4"><div class="card border-0 shadow-sm"><div class="card-body"><div class="small text-muted">Total Transaksi</div><div class="h4">{{ $summary['transactions'] }}</div></div></div></div>
    <div class="col-md-4"><div class="card border-0 shadow-sm"><div class="card-body"><div class="small text-muted">Total Pendapatan</div><div class="h4">Rp {{ number_format($summary['revenue'], 0, ',', '.') }}</div></div></div></div>
    <div class="col-md-4"><div class="card border-0 shadow-sm"><div class="card-body"><div class="small text-muted">Tiket Terjual</div><div class="h4">{{ $summary['tickets'] }}</div></div></div></div>
</div>
<div class="card border-0 shadow-sm"><div class="table-responsive">
    <table class="table mb-0"><thead><tr><th>Kode</th><th>Event</th><th>Jenis Tiket</th><th>Qty</th><th>Total Filter</th><th>Paid At</th></tr></thead><tbody>
    @foreach($transactions as $transaction)
        @php($details = $transaction->details
            ->when(request('event_id'), fn ($items) => $items->where('ticket.event_id', (int) request('event_id')))
            ->when(request('ticket_id'), fn ($items) => $items->where('ticket_id', (int) request('ticket_id'))))
        <tr>
            <td>{{ $transaction->code }}</td>
            <td>{{ $details->pluck('ticket.event.title')->filter()->unique()->implode(' | ') }}</td>
            <td>{{ $details->pluck('ticket.name')->filter()->unique()->implode(' | ') }}</td>
            <td>{{ $transaction->report_tickets }}</td>
            <td>Rp {{ number_format($transaction->report_amount, 0, ',', '.') }}</td>
            <td>{{ $transaction->paid_at?->format('d M Y H:i') }}</td>
        </tr>
    @endforeach
    </tbody></table>
</div></div>
<div class="mt-3">{{ $transactions->links() }}</div>
@endsection
