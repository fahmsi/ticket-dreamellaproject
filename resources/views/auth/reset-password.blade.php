@extends('layouts.app')
@section('title', 'Reset Password - Dreamella')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h1 class="h4 mb-3">Password Baru</h1>
                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="mb-3"><label class="form-label">Email</label><input class="form-control" type="email" name="email" value="{{ $email }}" required></div>
                        <div class="mb-3"><label class="form-label">Password Baru</label><input class="form-control" type="password" name="password" required></div>
                        <div class="mb-3"><label class="form-label">Konfirmasi Password</label><input class="form-control" type="password" name="password_confirmation" required></div>
                        <button class="btn btn-dream w-100">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
