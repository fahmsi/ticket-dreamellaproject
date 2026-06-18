@extends('layouts.app')
@section('title', 'Register - Dreamella')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h1 class="h4 mb-4">Register Pelanggan</h1>
                    <form method="post" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3"><label class="form-label">Nama</label><input class="form-control" name="name" value="{{ old('name') }}" required></div>
                        <div class="mb-3"><label class="form-label">Email</label><input class="form-control" type="email" name="email" value="{{ old('email') }}" required></div>
                        <div class="mb-3"><label class="form-label">Nomor Telepon</label><input class="form-control" name="phone" value="{{ old('phone') }}" required></div>
                        <div class="mb-3"><label class="form-label">Password</label><input class="form-control" type="password" name="password" required></div>
                        <div class="mb-3"><label class="form-label">Konfirmasi Password</label><input class="form-control" type="password" name="password_confirmation" required></div>
                        <button class="btn btn-dream w-100">Buat Akun</button>
                    </form>
                    <p class="mt-3 mb-0 text-center">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
