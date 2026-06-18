@extends('layouts.app')
@section('title', 'Pembayaran - Dreamella')
@section('content')
<div class="container py-5">
    <div class="mb-4">
        <div class="progress" style="height: 8px"><div class="progress-bar bg-danger" style="width: 60%"></div></div>
        <div class="d-flex justify-content-between small mt-2 text-muted"><span>Pilih Tiket</span><span>Pembayaran</span><span>Upload Bukti</span><span>Verifikasi</span><span>Tiket Terbit</span></div>
    </div>
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h1 class="h4">Instruksi Pembayaran</h1>
                    <p>Kode transaksi: <strong>{{ $transaction->code }}</strong></p>
                    <p>Total pembayaran: <strong>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</strong></p>
                    <div class="accordion" id="methods">
                        @foreach($methods as $method)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#method{{ $method->id }}" type="button">{{ strtoupper($method->type) }} - {{ $method->name }}</button>
                                </h2>
                                <div id="method{{ $method->id }}" class="accordion-collapse collapse" data-bs-parent="#methods">
                                    <div class="accordion-body">
                                        <div>Nama penerima: <strong>{{ $method->account_name }}</strong></div>
                                        @if($method->account_number)<div>Nomor: <strong>{{ $method->account_number }}</strong></div>@endif
                                        @if($method->qris_image)<img class="img-fluid mt-2" src="{{ asset('storage/'.$method->qris_image) }}" alt="QRIS">@endif
                                        <p class="small mt-2 mb-0">{{ $method->instructions }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="h5">Upload Bukti Pembayaran</h2>
                    <form method="post" action="{{ route('transactions.payment.upload', $transaction) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Metode Pembayaran</label>
                            <select class="form-select" name="payment_method_id" required>
                                @foreach($methods as $method)<option value="{{ $method->id }}">{{ strtoupper($method->type) }} - {{ $method->name }}</option>@endforeach
                            </select>
                        </div>
                        <div class="mb-3"><label class="form-label">Nama Pengirim</label><input class="form-control" name="payer_name" value="{{ auth()->user()->name }}" required></div>
                        <div class="mb-3">
                            <label class="form-label">Bukti transfer (JPG, PNG, PDF maks 2MB)</label>
                            <input class="form-control" type="file" name="proof_file" data-proof-preview="#proofName" required>
                            <div id="proofName" class="small text-muted mt-1"></div>
                        </div>
                        <button class="btn btn-dream w-100">Upload Bukti</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
