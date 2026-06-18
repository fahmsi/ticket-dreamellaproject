@extends('layouts.admin')
@section('title', 'Form Event - Dreamella')
@section('admin')
<h1 class="h3 mb-4">{{ $event->exists ? 'Edit Event' : 'Tambah Event' }}</h1>
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="post" action="{{ $event->exists ? route('admin.events.update', $event) : route('admin.events.store') }}" enctype="multipart/form-data">
            @csrf @if($event->exists) @method('put') @endif
            <div class="row g-3">
                <div class="col-md-8"><label class="form-label">Judul</label><input class="form-control" name="title" value="{{ old('title', $event->title) }}" required></div>
                <div class="col-md-4"><label class="form-label">Kategori</label><input class="form-control" name="category" value="{{ old('category', $event->category) }}"></div>
                <div class="col-12"><label class="form-label">Deskripsi</label><textarea class="form-control" name="description" rows="5" required>{{ old('description', $event->description) }}</textarea></div>
                <div class="col-md-4"><label class="form-label">Tanggal</label><input class="form-control" type="date" name="event_date" value="{{ old('event_date', $event->event_date?->format('Y-m-d')) }}" required></div>
                <div class="col-md-4"><label class="form-label">Jam</label><input class="form-control" type="time" name="event_time" value="{{ old('event_time', $event->event_time) }}"></div>
                <div class="col-md-4"><label class="form-label">Status</label><select class="form-select" name="status">@foreach(['draft','published','closed'] as $status)<option @selected(old('status', $event->status ?: 'draft') === $status)>{{ $status }}</option>@endforeach</select></div>
                <div class="col-md-8"><label class="form-label">Lokasi</label><input class="form-control" name="location" value="{{ old('location', $event->location) }}" required></div>
                <div class="col-md-4"><label class="form-label">Poster</label><input class="form-control" type="file" name="poster"></div>
            </div>
            <button class="btn btn-dream mt-4">Simpan</button>
        </form>
    </div>
</div>
@endsection
