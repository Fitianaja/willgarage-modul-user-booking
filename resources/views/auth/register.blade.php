@extends('layouts.app')

@section('title', 'Register Customer - WillGarage')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white fw-bold">Daftar Akun Customer</div>
            <div class="card-body">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor HP / WhatsApp</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password (Minimal 8 karakter)</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Daftar Sekarang</button>
                </form>
                <div class="mt-3 text-center">
                    <small>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
