@extends('layouts.app')
@section('title', 'Lupa Password - Dreamella')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h1 class="h4 mb-3">Reset Password</h1>
                    <form method="post" action="{{ route('password.email') }}">
                        @csrf
                        <label class="form-label">Email</label>
                        <input class="form-control mb-3" type="email" name="email" required>
                        <button class="btn btn-dream w-100">Kirim Link Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
