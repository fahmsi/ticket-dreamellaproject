@extends('layouts.admin')
@section('title', 'Metode Pembayaran - Dreamella')
@section('admin')
<h1 class="h3 mb-3">Metode Pembayaran Manual</h1>
<div class="row g-4">
    <div class="col-lg-7"><div class="card border-0 shadow-sm"><div class="table-responsive">
        <table class="table mb-0"><thead><tr><th>Tipe</th><th>Nama</th><th>Akun</th><th>Status</th><th></th></tr></thead><tbody>
        @foreach($methods as $method)
            <tr><td>{{ strtoupper($method->type) }}</td><td>{{ $method->name }}</td><td>{{ $method->account_name }}<br><span class="small text-muted">{{ $method->account_number }}</span></td><td>{{ $method->is_active ? 'Aktif' : 'Nonaktif' }}</td><td class="text-end"><form method="post" action="{{ route('admin.payment-methods.destroy', $method) }}">@csrf @method('delete')<button class="btn btn-sm btn-outline-danger">Hapus</button></form></td></tr>
        @endforeach
        </tbody></table>
    </div></div><div class="mt-3">{{ $methods->links() }}</div></div>
    <div class="col-lg-5"><div class="card border-0 shadow-sm"><div class="card-body">
        <h2 class="h5">Tambah Metode</h2>
        <form method="post" action="{{ route('admin.payment-methods.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-2"><select class="form-select" name="type"><option value="bank">Bank</option><option value="ewallet">E-Wallet</option><option value="qris">QRIS</option></select></div>
            <div class="mb-2"><input class="form-control" name="name" placeholder="BCA / DANA / QRIS" required></div>
            <div class="mb-2"><input class="form-control" name="account_name" placeholder="Nama penerima" required></div>
            <div class="mb-2"><input class="form-control" name="account_number" placeholder="Nomor rekening/e-wallet"></div>
            <div class="mb-2"><input class="form-control" type="file" name="qris_image"></div>
            <div class="mb-2"><textarea class="form-control" name="instructions" placeholder="Instruksi pembayaran"></textarea></div>
            <label class="form-check mb-3"><input class="form-check-input" type="checkbox" name="is_active" value="1" checked> <span class="form-check-label">Aktif</span></label>
            <button class="btn btn-dream w-100">Simpan</button>
        </form>
    </div></div></div>
</div>
@endsection
