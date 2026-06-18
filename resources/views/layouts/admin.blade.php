@extends('layouts.app')

@section('content')
<div class="container-fluid admin-shell">
    <div class="row">
        <aside class="col-lg-2 bg-white border-end p-3 admin-nav">
            <div class="fw-bold mb-3">Admin Dreamella</div>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.events.index') }}">Event</a>
            <a href="{{ route('admin.customers.index') }}">Pelanggan</a>
            <a href="{{ route('admin.transactions.index') }}">Transaksi</a>
            <a href="{{ route('admin.payments.index') }}">Verifikasi Pembayaran</a>
            <a href="{{ route('admin.reports.sales') }}">Laporan</a>
            <a href="{{ route('admin.payment-methods.index') }}">Metode Pembayaran</a>
            <a href="{{ route('admin.check-in.index') }}">Check-in</a>
        </aside>
        <main class="col-lg-10 p-4">
            @yield('admin')
        </main>
    </div>
</div>
@endsection
