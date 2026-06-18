@extends('layouts.admin')
@section('title', 'Verifikasi Pembayaran - Dreamella')
@section('admin')
<h1 class="h3 mb-3">Pembayaran Menunggu Verifikasi</h1>
<div class="card border-0 shadow-sm"><div class="table-responsive">
    <table class="table mb-0"><thead><tr><th>Transaksi</th><th>Pelanggan</th><th>Metode</th><th>Total</th><th>Upload</th><th></th></tr></thead><tbody>
    @forelse($payments as $payment)
        <tr><td>{{ $payment->transaction->code }}</td><td>{{ $payment->transaction->user->name }}</td><td>{{ $payment->method?->name }}</td><td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td><td>{{ $payment->uploaded_at?->format('d M Y H:i') }}</td><td class="text-end"><a class="btn btn-sm btn-dream" href="{{ route('admin.payments.show', $payment) }}">Periksa</a></td></tr>
    @empty
        <tr><td colspan="6" class="text-center text-muted py-4">Tidak ada pembayaran menunggu verifikasi.</td></tr>
    @endforelse
    </tbody></table>
</div></div>
<div class="mt-3">{{ $payments->links() }}</div>
@endsection
