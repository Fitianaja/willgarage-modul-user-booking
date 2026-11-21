@extends('layouts.app')

@section('title', 'About Us - Will Garage')

@section('content')
<div class="page-heading">About Us</div>

<div class="card-box" style="text-align: center; padding: 32px 20px; margin-bottom: 24px;">
    <div style="font-size: 46px; font-weight: 900; color: #FF6500; letter-spacing: -3px; line-height: 1; margin-bottom: 8px;">WG</div>
    <div style="font-size: 20px; font-weight: 800; color: #FF6500; margin-bottom: 4px;">Will Garage</div>
    <div style="font-size: 14px; color: #1E293B;">Sistem Pencatatan dan Penjadwalan Servis Kendaraan</div>
</div>

@php
    $members = [
        [
            'name' => 'Rena Noviana',
            'nim' => '2450081011',
            'role' => 'Backend',
            'github' => 'https://github.com',
        ],
        [
            'name' => 'Burhanudin Yusuf Athallah',
            'nim' => '2450081014',
            'role' => 'Frontend',
            'github' => 'https://github.comBurhanudinYA',
        ],
        [
            'name' => 'Muhamad Wildan',
            'nim' => '2450081018',
            'role' => 'Backend',
            'github' => 'https://github.com',
        ],
        [
            'name' => 'Novelia Zahra Nudhar Hasan',
            'nim' => '2450081019',
            'role' => 'Backend',
            'github' => 'https://github.com',
        ],
        [
            'name' => 'Fitian Abdurahman Assilmi',
            'nim' => '2450081034',
            'role' => 'Frontend',
            'github' => 'https://github.comnamakufitss',
        ],
    ];
@endphp

<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
    @foreach ($members as $member)
        <div class="card-box" style="text-align: center; padding: 26px 18px; margin-bottom: 0;">
            <div style="width: 48px; height: 48px; border-radius: 50%; border: 2.5px solid #0B192C; color: #0B192C; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; font-size: 20px; font-weight: 800;">
                {{ strtoupper(substr($member['name'], 0, 1)) }}
            </div>
            <div style="color: #FF6500; font-weight: 700; font-size: 15px; margin-bottom: 4px;">{{ $member['name'] }}</div>
            <div style="font-size: 12px; color: #475569; margin-bottom: 4px;">NIM. {{ $member['nim'] }} - {{ $member['role'] }}</div>
            <a href="{{ $member['github'] }}" target="_blank" style="font-size: 12px; color: #64748B; text-decoration: none;">{{ $member['github'] }}</a>
        </div>
    @endforeach
</div>
@endsection
