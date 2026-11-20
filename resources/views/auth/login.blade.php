@extends('layouts.app')

@section('title', 'Login - WillGarage')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white fw-bold">Login WillGarage</div>
            <div class="card-body">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Masuk</button>
                </form>
                <div class="mt-3 text-center">
                    <small>Belum punya akun Customer? <a href="{{ route('register') }}">Daftar di sini</a></small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
