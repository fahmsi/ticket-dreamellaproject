@extends('layouts.admin')
@section('title', 'Edit Tiket - Dreamella')
@section('admin')
<h1 class="h3 mb-4">Edit Tiket {{ $ticket->event->title }}</h1>
<div class="card border-0 shadow-sm"><div class="card-body">
    <form method="post" action="{{ route('admin.tickets.update', $ticket) }}">
        @csrf @method('put')
        <div class="mb-3"><label class="form-label">Nama</label><input class="form-control" name="name" value="{{ $ticket->name }}" required></div>
        <div class="mb-3"><label class="form-label">Deskripsi</label><textarea class="form-control" name="description">{{ $ticket->description }}</textarea></div>
        <div class="row g-3">
            <div class="col-md-3"><label class="form-label">Harga</label><input class="form-control" type="number" name="price" value="{{ $ticket->price }}" required></div>
            <div class="col-md-3"><label class="form-label">Kuota</label><input class="form-control" type="number" name="quota" value="{{ $ticket->quota }}" required></div>
            <div class="col-md-3"><label class="form-label">Mulai</label><input class="form-control" type="datetime-local" name="sale_start_at" value="{{ $ticket->sale_start_at?->format('Y-m-d\TH:i') }}"></div>
            <div class="col-md-3"><label class="form-label">Selesai</label><input class="form-control" type="datetime-local" name="sale_end_at" value="{{ $ticket->sale_end_at?->format('Y-m-d\TH:i') }}"></div>
        </div>
        <div class="mt-3"><label class="form-label">Status</label><select class="form-select" name="status"><option @selected($ticket->status === 'active')>active</option><option @selected($ticket->status === 'inactive')>inactive</option></select></div>
        <button class="btn btn-dream mt-4">Update</button>
    </form>
</div></div>
@endsection
