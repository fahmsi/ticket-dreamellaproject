@extends('layouts.admin')
@section('title', 'Kelola Tiket - Dreamella')
@section('admin')
<h1 class="h3 mb-3">Jenis Tiket: {{ $event->title }}</h1>
<div class="row g-4">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead><tr><th>Nama</th><th>Harga</th><th>Kuota</th><th>Terjual</th><th>Status</th><th></th></tr></thead>
                    <tbody>
                    @foreach($event->tickets as $ticket)
                        <tr><td>{{ $ticket->name }}</td><td>Rp {{ number_format($ticket->price, 0, ',', '.') }}</td><td>{{ $ticket->quota }}</td><td>{{ $ticket->sold_count }}</td><td>@include('partials.status', ['status' => $ticket->status])</td><td class="text-end"><a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.tickets.edit', $ticket) }}">Edit</a></td></tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm"><div class="card-body">
            <h2 class="h5">Tambah Tiket</h2>
            <form method="post" action="{{ route('admin.tickets.store', $event) }}">
                @csrf
                <div class="mb-2"><input class="form-control" name="name" placeholder="Nama tiket" required></div>
                <div class="mb-2"><textarea class="form-control" name="description" placeholder="Deskripsi"></textarea></div>
                <div class="row g-2 mb-2"><div class="col"><input class="form-control" type="number" name="price" placeholder="Harga" required></div><div class="col"><input class="form-control" type="number" name="quota" placeholder="Kuota" required></div></div>
                <div class="row g-2 mb-2"><div class="col"><input class="form-control" type="datetime-local" name="sale_start_at"></div><div class="col"><input class="form-control" type="datetime-local" name="sale_end_at"></div></div>
                <select class="form-select mb-3" name="status"><option value="active">active</option><option value="inactive">inactive</option></select>
                <button class="btn btn-dream w-100">Simpan Tiket</button>
            </form>
        </div></div>
    </div>
</div>
@endsection
