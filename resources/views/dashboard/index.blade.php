@extends('layouts.app')

@section('title', 'Dashboard - WillGarage')

@section('content')
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h4 class="mb-1">Selamat Datang, {{ $user->name }}!</h4>
        <p class="text-muted mb-0">Anda login sebagai: <strong>{{ strtoupper(str_replace('_', ' ', $user->role)) }}</strong></p>
    </div>
</div>

@if ($user->hasRole('customer'))
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card border-primary">
                <div class="card-body">
                    <h5>Kendaraan Saya</h5>
                    <p class="display-6 fw-bold">{{ $myVehiclesCount }}</p>
                    <a href="{{ route('customer.vehicles.index') }}" class="btn btn-primary btn-sm">Kelola Kendaraan</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-success">
                <div class="card-body">
                    <h5>Jadwal Servis Saya</h5>
                    <p class="display-6 fw-bold">{{ $myBookingsCount }}</p>
                    <a href="{{ route('customer.bookings.index') }}" class="btn btn-success btn-sm">Buat / Lihat Jadwal Servis</a>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card border-warning">
                <div class="card-body">
                    <h5>Booking Menunggu Verifikasi (Pending)</h5>
                    <p class="display-6 fw-bold">{{ $pendingBookings }}</p>
                    @if ($user->hasAnyRole(['admin', 'service_advisor']))
                        <a href="{{ route('staff.bookings.index') }}" class="btn btn-warning btn-sm">Kelola & Verifikasi Jadwal Servis</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-info">
                <div class="card-body">
                    <h5>Total Semua Jadwal Servis</h5>
                    <p class="display-6 fw-bold">{{ $totalBookings }}</p>
                    @if ($user->hasRole('admin'))
                        <a href="{{ route('admin.users.index') }}" class="btn btn-dark btn-sm">Manajemen Akun & Role</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
