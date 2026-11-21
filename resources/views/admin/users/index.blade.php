@extends('layouts.app')

@section('title', 'Manajemen Pengguna & Staf - Will Garage')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;">
    <div class="page-heading" style="margin-bottom: 0;">Manajemen Pengguna & Staf</div>
</div>

<div class="card-box">
    <h4 style="margin-bottom: 12px; color: #0B192C;">+ Tambah Data User / Staff Baru</h4>
    <form action="{{ route('admin.users.store') }}" method="POST" style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; align-items: end;">
        @csrf
        <div>
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div>
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div>
            <label class="form-label">No HP</label>
            <input type="text" name="phone_number" class="form-control" required>
        </div>
        <div>
            <label class="form-label">Role</label>
            <select name="role" class="form-control" required>
                <option value="service_advisor">Service Advisor</option>
                <option value="mechanic">Mechanic</option>
                <option value="admin">Admin</option>
                <option value="customer">Customer</option>
            </select>
        </div>
        <div>
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div style="grid-column: span 5; text-align: right; margin-top: 6px;">
            <button type="submit" class="btn-navy">+ Tambah Data User</button>
        </div>
    </form>
</div>

<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;">
    @foreach ($users as $item)
        <div class="card-box" style="margin-bottom: 0;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <div>
                    <div style="font-weight: 700; font-size: 15px;">{{ $item->name }}</div>
                    <div style="font-size: 12px; color: #64748B;">{{ $item->email }}</div>
                    <div style="font-weight: 700; font-size: 13px; margin-top: 6px; color: #0B192C;">
                        {{ ucwords(str_replace('_', ' ', $item->role)) }}
                    </div>
                </div>
                <div style="width: 42px; height: 42px; border-radius: 50%; border: 2px solid #FF6500; color: #FF6500; display: flex; align-items: center; justify-content: center; font-weight: 800;">
                    {{ strtoupper(substr($item->name, 0, 1)) }}
                </div>
            </div>

            <form action="{{ route('admin.users.update-role', $item) }}" method="POST" style="display: flex; gap: 6px;">
                @csrf
                @method('PATCH')
                <select name="role" class="form-control" style="padding: 6px; font-size: 12px;">
                    @foreach (['admin', 'service_advisor', 'mechanic', 'customer'] as $roleOption)
                        <option value="{{ $roleOption }}" @selected($item->role === $roleOption)>{{ ucwords(str_replace('_', ' ', $roleOption)) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-orange" style="padding: 6px 12px;">Ubah</button>
            </form>
        </div>
    @endforeach
</div>
@endsection
