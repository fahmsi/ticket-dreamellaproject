@extends('layouts.admin')
@section('title', 'Data Pelanggan - Dreamella')
@section('admin')
<h1 class="h3 mb-3">Data Pelanggan</h1>
<form class="mb-3 d-flex gap-2" method="get"><input class="form-control" name="q" value="{{ request('q') }}" placeholder="Cari nama/email"><button class="btn btn-outline-secondary">Cari</button></form>
<div class="card border-0 shadow-sm"><div class="table-responsive">
    <table class="table mb-0"><thead><tr><th>Nama</th><th>Email</th><th>Telepon</th><th>Transaksi</th><th></th></tr></thead><tbody>
    @foreach($customers as $customer)
        <tr><td>{{ $customer->name }}</td><td>{{ $customer->email }}</td><td>{{ $customer->phone }}</td><td>{{ $customer->transactions_count }}</td><td class="text-end"><a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.customers.show', $customer) }}">Detail</a></td></tr>
    @endforeach
    </tbody></table>
</div></div>
<div class="mt-3">{{ $customers->links() }}</div>
@endsection
