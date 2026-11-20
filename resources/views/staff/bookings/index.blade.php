@extends('layouts.app')

@section('title', 'Kelola Jadwal Servis (Staff) - WillGarage')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Daftar Masuk Booking Jadwal Servis</h4>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm">Kembali ke Dashboard</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-bordered align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Jadwal</th>
                    <th>Customer & Kendaraan</th>
                    <th>Keluhan</th>
                    <th>Verifikasi & Penugasan Mekanik</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <td>
                            <strong>{{ $booking->booking_date->format('d M Y') }}</strong><br>
                            <small>{{ $booking->booking_time }}</small><br>
                            <span class="badge bg-info text-dark mt-1">{{ strtoupper($booking->status) }}</span>
                        </td>
                        <td>
                            <strong>{{ $booking->customer->name }}</strong> ({{ $booking->customer->phone_number }})<br>
                            <small>{{ $booking->vehicle->plate_number }} - {{ $booking->vehicle->brand }} {{ $booking->vehicle->model }}</small>
                        </td>
                        <td>{{ $booking->complaint }}</td>
                        <td>
                            <form action="{{ route('staff.bookings.update', $booking) }}" method="POST" class="row g-2">
                                @csrf
                                @method('PATCH')
                                <div class="col-md-4">
                                    <select name="status" class="form-select form-select-sm" required>
                                        @foreach (['pending', 'confirmed', 'in_progress', 'completed', 'cancelled'] as $status)
                                            <option value="{{ $status }}" @selected($booking->status === $status)>{{ strtoupper($status) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="mechanic_id" class="form-select form-select-sm">
                                        <option value="">-- Pilih Mekanik --</option>
                                        @foreach ($mechanics as $mechanic)
                                            <option value="{{ $mechanic->id }}" @selected($booking->mechanic_id === $mechanic->id)>{{ $mechanic->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary btn-sm w-100">Simpan</button>
                                </div>
                                <div class="col-12">
                                    <input type="text" name="advisor_notes" value="{{ $booking->advisor_notes }}" placeholder="Catatan Service Advisor untuk customer/mekanik..." class="form-control form-control-sm">
                                </div>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-3">Belum ada jadwal booking masuk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
