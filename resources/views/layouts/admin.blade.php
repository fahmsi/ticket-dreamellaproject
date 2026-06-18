@extends('layouts.app')

@section('content')
<div class="container-fluid admin-shell">
    <div class="row">
        <aside class="col-lg-2 p-3 admin-nav admin-sidebar">
            <div class="admin-sidebar-title mb-3 d-flex align-items-center gap-2">
                <span class="brand-dot"></span>
                Admin Dreamella
            </div>
            <a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a href="{{ route('admin.events.index') }}"><i class="bi bi-calendar-event"></i> Event</a>
            <a href="{{ route('admin.customers.index') }}"><i class="bi bi-people"></i> Pelanggan</a>
            <a href="{{ route('admin.transactions.index') }}"><i class="bi bi-receipt"></i> Transaksi</a>
            <a href="{{ route('admin.payments.index') }}"><i class="bi bi-shield-check"></i> Verifikasi Pembayaran</a>
            <a href="{{ route('admin.reports.sales') }}"><i class="bi bi-bar-chart"></i> Laporan</a>
            <a href="{{ route('admin.payment-methods.index') }}"><i class="bi bi-credit-card"></i> Metode Pembayaran</a>
            <a href="{{ route('admin.check-in.index') }}"><i class="bi bi-qr-code-scan"></i> Check-in</a>
        </aside>
        <main class="col-lg-10 p-4">
            @yield('admin')
        </main>
    </div>
</div>
@endsection
