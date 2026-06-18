@extends('layouts.app')
@section('title', 'Profil Saya - Dreamella')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h1 class="h4 mb-4">Profil Saya</h1>
                    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf @method('put')
                        <div class="mb-3"><label class="form-label">Nama</label><input class="form-control" name="name" value="{{ old('name', $user->name) }}" required></div>
                        <div class="mb-3"><label class="form-label">Email</label><input class="form-control" value="{{ $user->email }}" disabled></div>
                        <div class="mb-3"><label class="form-label">Nomor Telepon</label><input class="form-control" name="phone" value="{{ old('phone', $user->phone) }}"></div>
                        <div class="mb-3"><label class="form-label">Avatar</label><input class="form-control" type="file" name="avatar"></div>
                        <div class="mb-3"><label class="form-label">Password Baru</label><input class="form-control" type="password" name="password"></div>
                        <div class="mb-3"><label class="form-label">Konfirmasi Password Baru</label><input class="form-control" type="password" name="password_confirmation"></div>
                        <button class="btn btn-dream">Simpan Profil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
