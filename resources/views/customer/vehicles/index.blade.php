@extends('layouts.app')

@section('title', 'Data Kendaraan - Will Garage')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;">
    <div class="page-heading" style="margin-bottom: 0;">Data Kendaraan</div>
</div>

<div class="card-box">
    <h4 style="margin-bottom: 12px; color: #0B192C;">+ Tambah Kendaraan Baru</h4>
    <form action="{{ route('customer.vehicles.store') }}" method="POST" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; align-items: end;">
        @csrf
        <div>
            <label class="form-label">Nomor Plat</label>
            <input type="text" name="plate_number" placeholder="Contoh: D 1234 ABC" class="form-control" required>
        </div>
        <div>
            <label class="form-label">Merek</label>
            <input type="text" name="brand" placeholder="Contoh: Honda / Toyota" class="form-control" required>
        </div>
        <div>
            <label class="form-label">Model / Tipe</label>
            <input type="text" name="model" placeholder="Contoh: Vario 125 / Avanza" class="form-control" required>
        </div>
        <div>
            <label class="form-label">Tahun</label>
            <input type="number" name="year" placeholder="2023" class="form-control">
        </div>
        <div style="grid-column: span 4; text-align: right; margin-top: 6px;">
            <button type="submit" class="btn-navy">+ Tambah Kendaraan</button>
        </div>
    </form>
</div>

<div class="card-box" style="padding: 0; overflow: hidden;">
    <table class="wg-table">
        <thead>
            <tr>
                <th>Nomor Plat</th>
                <th>Pemilik</th>
                <th>Merk & Model</th>
                <th>Tahun</th>
                <th>No HP</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($vehicles as $vehicle)
                <tr>
                    <td style="font-weight: 700;">{{ $vehicle->plate_number }}</td>
                    <td>{{ auth()->user()->name }}</td>
                    <td>{{ $vehicle->brand }} {{ $vehicle->model }}</td>
                    <td>{{ $vehicle->year ?? '-' }}</td>
                    <td>{{ auth()->user()->phone_number ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #64748B; padding: 24px;">Belum ada kendaraan terdaftar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
