@extends('layouts.app')

@section('title', 'Kendaraan Saya - WillGarage')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Data Kendaraan Saya</h4>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm">Kembali ke Dashboard</a>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">Tambah Kendaraan</div>
            <div class="card-body">
                <form action="{{ route('customer.vehicles.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nomor Polisi (Plat)</label>
                        <input type="text" name="plate_number" placeholder="Contoh: D 1234 ABC" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Merek</label>
                        <input type="text" name="brand" placeholder="Contoh: Honda / Toyota" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipe / Model</label>
                        <input type="text" name="model" placeholder="Contoh: Vario 160 / Avanza" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tahun (Opsional)</label>
                        <input type="number" name="year" placeholder="2023" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan Kendaraan</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">Daftar Kendaraan Terdaftar</div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Plat Nomor</th>
                            <th>Merek</th>
                            <th>Model</th>
                            <th>Tahun</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($vehicles as $vehicle)
                            <tr>
                                <td class="fw-bold">{{ $vehicle->plate_number }}</td>
                                <td>{{ $vehicle->brand }}</td>
                                <td>{{ $vehicle->model }}</td>
                                <td>{{ $vehicle->year ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">Belum ada kendaraan terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
