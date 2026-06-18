@extends('layouts.app')
@section('title', 'Daftar Event - Dreamella')
@section('content')
<div class="container py-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1">Daftar Event</h1>
            <p class="text-muted mb-0">Cari event Dreamella Project yang tersedia.</p>
        </div>
        <form class="d-flex flex-wrap gap-2" method="get">
            <input class="form-control" name="q" placeholder="Cari event" value="{{ request('q') }}">
            <select class="form-select" name="category">
                <option value="">Semua kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
                @endforeach
            </select>
            <input class="form-control" type="date" name="date" value="{{ request('date') }}">
            <button class="btn btn-outline-secondary"><i class="bi bi-search"></i></button>
        </form>
    </div>
    <div class="row g-4">
        @forelse($events as $event)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="event-poster">{{ $event->title }}</div>
                    <div class="card-body">
                        @php($soldOut = $event->tickets->sum('sold_count') >= $event->tickets->sum('quota'))
                        <span class="badge text-bg-{{ $soldOut ? 'danger' : 'success' }}">{{ $soldOut ? 'Sold Out' : 'Available' }}</span>
                        <h2 class="h5 mt-3">{{ $event->title }}</h2>
                        <p class="small text-muted mb-1">{{ $event->event_date->format('d M Y') }} {{ $event->event_time }}</p>
                        <p class="small text-muted">{{ $event->location }}</p>
                        <div class="fw-bold mb-3">Mulai Rp {{ number_format($event->minimumPrice(), 0, ',', '.') }}</div>
                        <a class="btn btn-dream w-100" href="{{ route('events.show', $event) }}">Beli Tiket</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12"><div class="alert alert-info">Event tidak ditemukan.</div></div>
        @endforelse
    </div>
    <div class="mt-4">{{ $events->links() }}</div>
</div>
@endsection
