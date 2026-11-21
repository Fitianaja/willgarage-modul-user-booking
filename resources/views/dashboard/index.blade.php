@extends('layouts.app')

@section('title', 'Homepage - Will Garage')

@section('content')
<div style="background-color: #0B192C; color: #fff; border-radius: 16px; padding: 24px 28px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <div>
        <span style="background: rgba(255,101,0,0.2); color: #FF6500; padding: 4px 10px; border-radius: 999px; font-size: 11px; font-weight: 700;">Overview Bengkel Hari Ini</span>
        <h2 style="margin-top: 8px; font-size: 24px;">Welcome Back Again, {{ $user->name }}</h2>
        <p style="color: #94A3B8; font-size: 13px; margin-top: 4px;">
            @if ($user->hasRole('customer'))
                Kelola kendaraan dan pantau jadwal servis kendaraan Anda secara real-time.
            @else
                Ada {{ $pendingBookings }} antrean service menunggu verifikasi & pengerjaan.
            @endif
        </p>
    </div>
    <div>
        @if ($user->hasRole('customer'))
            <a href="{{ route('customer.bookings.index') }}" class="btn-orange">+ Booking Service</a>
        @else
            <a href="{{ route('staff.bookings.index') }}" class="btn-orange">Kelola Jadwal Service</a>
        @endif
    </div>
</div>

@if ($user->hasRole('customer'))
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 18px;">
        <div class="card-box">
            <div style="font-size: 13px; color: #64748B;">Kendaraan Terdaftar</div>
            <div style="font-size: 32px; font-weight: 800; margin: 8px 0;">{{ $myVehiclesCount }}</div>
            <a href="{{ route('customer.vehicles.index') }}" class="btn-navy">Lihat Data Kendaraan</a>
        </div>
        <div class="card-box">
            <div style="font-size: 13px; color: #64748B;">Total Jadwal Servis Saya</div>
            <div style="font-size: 32px; font-weight: 800; margin: 8px 0;">{{ $myBookingsCount }}</div>
            <a href="{{ route('customer.bookings.index') }}" class="btn-orange">Lihat Jadwal Service</a>
        </div>
    </div>
@else
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 18px;">
        <div class="card-box">
            <div style="font-size: 13px; color: #64748B;">Antrean Menunggu Verifikasi (Pending)</div>
            <div style="font-size: 32px; font-weight: 800; margin: 8px 0; color: #FF6500;">{{ $pendingBookings }}</div>
            <a href="{{ route('staff.bookings.index') }}" class="btn-orange">Buka Board Jadwal Service</a>
        </div>
        <div class="card-box">
            <div style="font-size: 13px; color: #64748B;">Total Semua Jadwal Servis</div>
            <div style="font-size: 32px; font-weight: 800; margin: 8px 0;">{{ $totalBookings }}</div>
            @if ($user->hasRole('admin'))
                <a href="{{ route('admin.users.index') }}" class="btn-navy">Kelola User & Staff</a>
            @endif
        </div>
    </div>
@endif
@endsection
