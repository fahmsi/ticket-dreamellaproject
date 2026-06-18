@extends('layouts.admin')
@section('title', 'Check-in Tiket - Dreamella')
@section('admin')
<h1 class="h3 mb-3">Validasi Tiket / Check-in</h1>
<div class="card border-0 shadow-sm mb-4"><div class="card-body">
    <form method="post" action="{{ route('admin.check-in.validate') }}" class="row g-2">
        @csrf
        <div class="col-md-9"><input class="form-control form-control-lg" name="code" value="{{ request('code') }}" placeholder="Masukkan kode tiket" required></div>
        <div class="col-md-3"><button class="btn btn-dream btn-lg w-100">Validasi</button></div>
    </form>
</div></div>
@if(request('code'))
    @if($ticket)
        <div class="card border-0 shadow-sm"><div class="card-body">
            <div class="d-flex justify-content-between"><h2 class="h5">{{ $ticket->event->title }}</h2>@include('partials.status', ['status' => $ticket->status])</div>
            <p><strong>Kode:</strong> {{ $ticket->ticket_code }}<br><strong>Pemilik:</strong> {{ $ticket->user->name }}<br><strong>Jenis:</strong> {{ $ticket->ticket->name }}</p>
            @if($ticket->status === 'active')
                <form method="post" action="{{ route('admin.check-in.mark-used', $ticket) }}">@csrf<button class="btn btn-success">Tandai Used / Check-in</button></form>
            @else
                <div class="alert alert-warning mb-0">Tiket tidak bisa digunakan karena statusnya {{ $ticket->status }}.</div>
            @endif
        </div></div>
    @else
        <div class="alert alert-danger">Kode tiket tidak ditemukan.</div>
    @endif
@endif
@endsection
