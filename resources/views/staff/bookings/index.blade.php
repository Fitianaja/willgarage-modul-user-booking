@extends('layouts.app')

@section('title', 'Penjadwalan & Service - Will Garage')

@section('content')
<div class="page-heading">Penjadwalan & Service</div>

@php
    $columns = [
        'pending' => 'Menunggu Antrean',
        'in_progress' => 'Sedang Dikerjakan',
        'completed' => 'Selesai',
    ];
@endphp

<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
    @foreach ($columns as $statusKey => $columnTitle)
        <div class="card-box" style="min-height: 420px;">
            <h3 style="text-align: center; font-size: 17px; margin-bottom: 16px; color: #0B192C;">{{ $columnTitle }}</h3>

            @forelse ($bookings->whereIn('status', $statusKey === 'pending' ? ['pending', 'confirmed'] : [$statusKey]) as $booking)
                <div style="border: 1px solid #94A3B8; border-radius: 14px; padding: 16px; margin-bottom: 16px; text-align: center;">
                    <div style="font-weight: 800; font-size: 16px; margin-bottom: 8px;">{{ $booking->vehicle->plate_number }}</div>
                    <div style="font-size: 14px; margin-bottom: 10px;">{{ $booking->complaint }}</div>
                    <div style="font-size: 13px; color: #475569;">Pemilik : {{ $booking->customer->name }}</div>
                    <div style="font-size: 13px; color: #475569; margin-bottom: 12px;">
                        Mekanik : {{ $booking->mechanic->name ?? 'Belum ditentukan' }}
                    </div>

                    <form action="{{ route('staff.bookings.update', $booking) }}" method="POST" style="text-align: left; border-top: 1px solid #E2E8F0; padding-top: 10px;">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <select name="mechanic_id" class="form-control" style="font-size: 12px; padding: 6px;">
                                <option value="">-- Pilih Mekanik --</option>
                                @foreach ($mechanics as $mechanic)
                                    <option value="{{ $mechanic->id }}" @selected($booking->mechanic_id === $mechanic->id)>{{ $mechanic->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="advisor_notes" value="{{ $booking->advisor_notes }}" placeholder="Catatan SA..." class="form-control" style="font-size: 12px; padding: 6px;">
                        </div>

                        @if ($statusKey === 'pending')
                            <input type="hidden" name="status" value="in_progress">
                            <button type="submit" class="btn-navy" style="width: 100%;">Mulai Kerjakan</button>
                        @elseif ($statusKey === 'in_progress')
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" class="btn-orange" style="width: 100%; border-radius: 999px;">Selesai</button>
                        @else
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" class="btn-navy" style="width: 100%;">Simpan Perubahan</button>
                        @endif
                    </form>
                </div>
            @empty
                <p style="text-align: center; color: #94A3B8; font-size: 13px; margin-top: 40px;">Tidak ada kendaraan di kolom ini.</p>
            @endforelse
        </div>
    @endforeach
</div>
@endsection
