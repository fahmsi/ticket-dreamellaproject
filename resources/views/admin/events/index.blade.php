@extends('layouts.admin')
@section('title', 'Kelola Event - Dreamella')
@section('admin')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Kelola Event</h1>
    <a class="btn btn-dream" href="{{ route('admin.events.create') }}"><i class="bi bi-plus-lg"></i> Event</a>
</div>
<form class="mb-3 d-flex gap-2" method="get"><input class="form-control" name="q" value="{{ request('q') }}" placeholder="Cari event"><button class="btn btn-outline-secondary">Cari</button></form>
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead><tr><th>Judul</th><th>Tanggal</th><th>Status</th><th>Tiket</th><th></th></tr></thead>
            <tbody>
            @foreach($events as $event)
                <tr>
                    <td>{{ $event->title }}</td><td>{{ $event->event_date->format('d M Y') }}</td><td>@include('partials.status', ['status' => $event->status])</td><td>{{ $event->tickets_count }}</td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.events.tickets', $event) }}">Tiket</a>
                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.events.edit', $event) }}">Edit</a>
                        <form class="d-inline" method="post" action="{{ route('admin.events.destroy', $event) }}">@csrf @method('delete')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus event?')">Hapus</button></form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $events->links() }}</div>
@endsection
