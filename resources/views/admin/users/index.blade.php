@extends('layouts.app')

@section('title', 'Manajemen Akun & Role - WillGarage')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Manajemen Akun Pengguna & Staff</h4>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm">Kembali ke Dashboard</a>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">Tambah Akun Staff / User</div>
            <div class="card-body">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Nomor HP</label>
                        <input type="text" name="phone_number" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Role / Hak Akses</label>
                        <select name="role" class="form-select" required>
                            <option value="service_advisor">Service Advisor</option>
                            <option value="mechanic">Mechanic</option>
                            <option value="admin">Admin</option>
                            <option value="customer">Customer</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password Awal (Min 8 karakter)</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Buat Akun</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">Daftar Seluruh Pengguna</div>
            <div class="card-body p-0">
                <table class="table table-striped align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Nama & Email</th>
                            <th>No HP</th>
                            <th>Role Saat Ini</th>
                            <th>Ubah Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                            <tr>
                                <td><strong>{{ $item->name }}</strong><br><small>{{ $item->email }}</small></td>
                                <td>{{ $item->phone_number ?? '-' }}</td>
                                <td><span class="badge bg-dark">{{ strtoupper(str_replace('_', ' ', $item->role)) }}</span></td>
                                <td>
                                    <form action="{{ route('admin.users.update-role', $item) }}" method="POST" class="d-flex gap-1">
                                        @csrf
                                        @method('PATCH')
                                        <select name="role" class="form-select form-select-sm">
                                            @foreach (['admin', 'service_advisor', 'mechanic', 'customer'] as $roleOption)
                                                <option value="{{ $roleOption }}" @selected($item->role === $roleOption)>{{ strtoupper(str_replace('_', ' ', $roleOption)) }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Ubah</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
