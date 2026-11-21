@extends('layouts.app')

@section('title', 'Jadwal Service - Will Garage')

@section('content')
<div class="page-heading">Jadwal Service Saya</div>

<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px; align-items: start;">
    <div class="card-box">
        <h4 style="margin-bottom: 14px; color: #0B192C;">+ Booking Jadwal Servis</h4>

        @if ($vehicles->isEmpty())
            <div class="alert-danger" style="margin-bottom: 0;">
                Anda belum memiliki kendaraan. <a href="{{ route('customer.vehicles.index') }}" style="font-weight: 700; color: #991B1B;">Tambahkan kendaraan dulu</a> sebelum melakukan booking.
            </div>
        @else
            <form action="{{ route('customer.bookings.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Pilih Kendaraan</label>
                    <select name="vehicle_id" class="form-control" required>
                        <option value="">-- Pilih Kendaraan --</option>
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}">{{ $vehicle->plate_number }} - {{ $vehicle->brand }} {{ $vehicle->model }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal Servis</label>
                    <input type="date" name="booking_date" min="{{ date('Y-m-d') }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Jam Kedatangan</label>
                    <input type="time" name="booking_time" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Keluhan / Layanan Servis</label>
                    <textarea name="complaint" rows="3" class="form-control" placeholder="Contoh: Ganti kampas rem, servis berkala" required></textarea>
                </div>
                <button type="submit" class="btn-orange" style="width: 100%; text-align: center;">Kirim Jadwal Booking</button>
            </form>
        @endif
    </div>

    <div class="card-box" style="padding: 0; overflow: hidden;">
        <table class="wg-table">
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
                        <td>
                            <strong>{{ $booking->booking_date->format('d M Y') }}</strong><br>
                            <small style="color: #64748B;">{{ $booking->booking_time }}</small>
                        </td>
                        <td>
                            <strong>{{ $booking->vehicle->plate_number }}</strong><br>
                            <small>{{ $booking->vehicle->brand }} {{ $booking->vehicle->model }}</small>
                        </td>
                        <td>
                            {{ $booking->complaint }}
                            @if ($booking->advisor_notes)
                                <div style="font-size: 12px; color: #FF6500; margin-top: 4px;">Catatan SA: {{ $booking->advisor_notes }}</div>
                            @endif
                        </td>
                        <td>
                            <span style="background: #0B192C; color: #fff; padding: 4px 10px; border-radius: 999px; font-size: 11px; font-weight: 700;">
                                {{ strtoupper(str_replace('_', ' ', $booking->status)) }}
                            </span>
                        </td>
                        <td>
                            @if ($booking->status === 'pending')
                                <form action="{{ route('customer.bookings.cancel', $booking) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn-orange" style="padding: 5px 10px; font-size: 12px;" onclick="return confirm('Batalkan jadwal ini?')">Batalkan</button>
                                </form>
                            @else
                                <span style="color: #94A3B8; font-size: 12px;">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: #64748B; padding: 24px;">Belum ada jadwal servis.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
