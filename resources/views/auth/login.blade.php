@extends('layouts.app')
@section('title', 'Login - Dreamella')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h1 class="h4 mb-4">Login</h1>
                    <form method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input class="form-control" type="password" name="password" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-check"><input class="form-check-input" type="checkbox" name="remember"> <span class="form-check-label">Ingat saya</span></label>
                            <a href="{{ route('password.request') }}">Lupa password?</a>
                        </div>
                        <button class="btn btn-dream w-100">Login</button>
                    </form>
                    <p class="mt-3 mb-0 text-center">Belum punya akun? <a href="{{ route('register') }}">Register</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
