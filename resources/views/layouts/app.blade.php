<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Will Garage - Sistem Service Kendaraan')</title>
    <style>
        :root {
            --wg-navy: #0B192C;
            --wg-navy-light: #132640;
            --wg-orange: #FF6500;
            --wg-orange-hover: #e05900;
            --wg-bg: #F8FAFC;
            --wg-border: #CBD5E1;
            --wg-text: #1E293B;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: var(--wg-bg); color: var(--wg-text); display: flex; min-height: 100vh; }

        /* Sidebar */
        .sidebar {
            width: 240px;
            background-color: var(--wg-navy);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: fixed;
            top: 0; bottom: 0; left: 0;
            padding: 20px 14px;
        }
        .brand-logo {
            text-align: center;
            font-size: 32px;
            font-weight: 900;
            color: var(--wg-orange);
            letter-spacing: -2px;
            margin-bottom: 24px;
            text-decoration: none;
            display: block;
            text-shadow: 1px 1px 0 #fff;
        }
        .menu-label {
            font-size: 11px;
            color: var(--wg-orange);
            text-transform: uppercase;
            margin: 14px 10px 6px;
            font-weight: 700;
        }
        .nav-link {
            display: block;
            color: #E2E8F0;
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 4px;
            transition: 0.2s;
        }
        .nav-link:hover { background-color: var(--wg-navy-light); color: #fff; }
        .nav-link.active { background-color: var(--wg-orange); color: #fff; font-weight: 600; }

        .sidebar-footer {
            border-top: 1px solid #1E3A5F;
            padding-top: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
        }
        .avatar-circle {
            width: 34px; height: 34px;
            border-radius: 50%;
            border: 2px solid #fff;
            display: flex; align-items: center; justify-content: center;
            font-weight: bold;
        }

        /* Main Area */
        .main-wrapper { margin-left: 240px; flex: 1; display: flex; flex-direction: column; }
        .topbar {
            background: #fff;
            border-bottom: 1px solid var(--wg-border);
            padding: 14px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .topbar-title { color: var(--wg-orange); font-size: 24px; font-weight: 800; }
        .topbar-actions { display: flex; align-items: center; gap: 10px; }
        .badge-open {
            background-color: var(--wg-orange);
            color: #fff;
            padding: 7px 16px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
        }
        .btn-signout {
            background-color: var(--wg-orange);
            color: #fff;
            border: none;
            padding: 7px 16px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-signout:hover { background-color: var(--wg-orange-hover); }

        .content-area { padding: 26px 28px; }
        .page-heading { color: var(--wg-orange); font-size: 22px; font-weight: 700; margin-bottom: 18px; }

        /* Buttons & Cards */
        .btn-orange {
            background-color: var(--wg-orange); color: #fff; border: none;
            padding: 9px 18px; border-radius: 8px; font-weight: 600; cursor: pointer; text-decoration: none; display: inline-block; font-size: 13px;
        }
        .btn-orange:hover { background-color: var(--wg-orange-hover); }
        .btn-navy {
            background-color: var(--wg-navy); color: #fff; border: none;
            padding: 9px 18px; border-radius: 999px; font-weight: 600; cursor: pointer; text-decoration: none; display: inline-block; font-size: 13px;
        }
        .card-box {
            background: #fff;
            border: 1px solid #94A3B8;
            border-radius: 14px;
            padding: 18px;
            margin-bottom: 20px;
        }
        .alert-success { background: #DCFCE7; border: 1px solid #22C55E; color: #166534; padding: 12px 16px; border-radius: 10px; margin-bottom: 16px; font-size: 14px; }
        .alert-danger { background: #FEE2E2; border: 1px solid #EF4444; color: #991B1B; padding: 12px 16px; border-radius: 10px; margin-bottom: 16px; font-size: 14px; }

        /* Table */
        .wg-table { width: 100%; border-collapse: collapse; font-size: 14px; }
        .wg-table th { text-align: left; padding: 12px; border-bottom: 1px solid #94A3B8; color: #0F172A; }
        .wg-table td { padding: 12px; border-bottom: 1px solid #E2E8F0; }

        /* Form Inputs */
        .form-group { margin-bottom: 12px; }
        .form-label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 4px; color: var(--wg-navy); }
        .form-control { width: 100%; padding: 9px 12px; border: 1px solid #94A3B8; border-radius: 8px; font-size: 14px; }
    </style>
</head>
<body>
    @auth
    <aside class="sidebar">
        <div>
            <a href="{{ route('dashboard') }}" class="brand-logo">WG</a>

            <div class="menu-label">Main Menu</div>
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Homepage</a>

            @if (auth()->user()->hasRole('customer'))
                <a href="{{ route('customer.vehicles.index') }}" class="nav-link {{ request()->routeIs('customer.vehicles.*') ? 'active' : '' }}">Data Kendaraan</a>
                <a href="{{ route('customer.bookings.index') }}" class="nav-link {{ request()->routeIs('customer.bookings.*') ? 'active' : '' }}">Jadwal Service</a>
            @endif

            @if (auth()->user()->hasAnyRole(['admin', 'service_advisor']))
                <a href="{{ route('staff.bookings.index') }}" class="nav-link {{ request()->routeIs('staff.bookings.*') ? 'active' : '' }}">Jadwal Service</a>
            @endif

            @if (auth()->user()->hasRole('admin'))
                <div class="menu-label">Sistem</div>
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">User & Staff</a>
            @endif
        </div>

        <div class="sidebar-footer">
            <div class="avatar-circle">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div style="font-weight: 600;">{{ auth()->user()->name }}</div>
                <div style="font-size: 11px; color: #94A3B8;">{{ ucwords(str_replace('_', ' ', auth()->user()->role)) }}</div>
            </div>
        </div>
    </aside>

    <div class="main-wrapper">
        <header class="topbar">
            <div class="topbar-title">Will Garage</div>
            <div class="topbar-actions">
                <span class="badge-open">Bengkel Buka (08.00 - 18.00)</span>
                <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" class="btn-signout">Sign Out</button>
                </form>
            </div>
        </header>

        <main class="content-area">
            @if (session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert-danger">
                    <ul style="margin-left: 18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
    @else
        @yield('content')
    @endauth
</body>
</html>
