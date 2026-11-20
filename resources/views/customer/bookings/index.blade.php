@extends('layouts.app')

@section('title', 'Jadwal Servis Saya - WillGarage')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Booking Jadwal Servis</h4>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm">Kembali ke Dashboard</a>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">Buat Jadwal Servis Baru</div>
            <div class="card-body">
                @if ($vehicles->isEmpty())
                    <div class="alert alert-warning mb-0">
                        Anda belum memiliki kendaraan. <a href="{{ route('customer.vehicles.index') }}">Tambahkan kendaraan dulu</a> sebelum booking.
                    </div>
                @else
                    <form action="{{ route('customer.bookings.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Pilih Kendaraan</label>
                            <select name="vehicle_id" class="form-select" required>
                                <option value="">-- Pilih Kendaraan --</option>
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->plate_number }} - {{ $vehicle->brand }} {{ $vehicle->model }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Servis</label>
                            <input type="date" name="booking_date" min="{{ date('Y-m-d') }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jam Kedatangan</label>
                            <input type="time" name="booking_time" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keluhan / Layanan yang Diinginkan</label>
                            <textarea name="complaint" rows="3" class="form-control" placeholder="Contoh: Servis rutin, ganti oli, rem berbunyi" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Kirim Jadwal Booking</button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">Riwayat & Status Jadwal Servis</div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Tanggal & Jam</th>
                            <th>Kendaraan</th>
                            <th>Keluhan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->booking_date->format('d M Y') }}<br><small class="text-muted">{{ $booking->booking_time }}</small></td>
                                <td><strong>{{ $booking->vehicle->plate_number }}</strong><br><small>{{ $booking->vehicle->brand }} {{ $booking->vehicle->model }}</small></td>
                                <td>
                                    {{ $booking->complaint }}
                                    @if ($booking->advisor_notes)
                                        <div class="small text-primary mt-1">Catatan Staff: {{ $booking->advisor_notes }}</div>
                                    @endif
                                </td>
                                <td><span class="badge bg-secondary">{{ strtoupper($booking->status) }}</span></td>
                                <td>
                                    @if ($booking->status === 'pending')
                                        <form action="{{ route('customer.bookings.cancel', $booking) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Batalkan jadwal ini?')">Batalkan</button>
                                        </form>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">Belum ada jadwal servis.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
