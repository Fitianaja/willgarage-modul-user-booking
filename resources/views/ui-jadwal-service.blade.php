<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjadwalan & Service - Will Garage</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif; }
        body { background-color: #F8FAFC; color: #1E293B; display: flex; min-height: 100vh; }

        /* Sidebar */
        .sidebar { width: 240px; background-color: #0B192C; color: #fff; display: flex; flex-direction: column; justify-content: space-between; position: fixed; top: 0; bottom: 0; left: 0; padding: 20px 14px; }
        .brand-logo { text-align: center; font-size: 32px; font-weight: 900; color: #FF6500; letter-spacing: -2px; margin-bottom: 24px; text-decoration: none; display: block; text-shadow: 1px 1px 0 #fff; }
        .menu-label { font-size: 11px; color: #FF6500; text-transform: uppercase; margin: 14px 10px 6px; font-weight: 700; }
        .nav-link { display: block; color: #E2E8F0; text-decoration: none; padding: 10px 14px; border-radius: 8px; font-size: 14px; margin-bottom: 4px; }
        .nav-link.active { background-color: #FF6500; color: #fff; font-weight: 600; }
        .sidebar-footer { border-top: 1px solid #1E3A5F; padding-top: 14px; display: flex; align-items: center; gap: 10px; font-size: 13px; }
        .avatar-circle { width: 34px; height: 34px; border-radius: 50%; border: 2px solid #fff; display: flex; align-items: center; justify-content: center; font-weight: bold; }

        /* Main Area */
        .main-wrapper { margin-left: 240px; flex: 1; display: flex; flex-direction: column; }
        .topbar { background: #fff; border-bottom: 1px solid #CBD5E1; padding: 14px 28px; display: flex; justify-content: space-between; align-items: center; }
        .topbar-title { color: #FF6500; font-size: 24px; font-weight: 800; }
        .topbar-actions { display: flex; align-items: center; gap: 10px; }
        .badge-orange { background-color: #FF6500; color: #fff; padding: 7px 16px; border-radius: 999px; font-size: 13px; font-weight: 600; }

        .content-area { padding: 26px 28px; }
        .header-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px; }
        .page-heading { color: #FF6500; font-size: 22px; font-weight: 700; }
        .btn-navy { background-color: #0B192C; color: #fff; border: none; padding: 10px 20px; border-radius: 999px; font-size: 13px; font-weight: 600; cursor: pointer; }

        /* Kanban 3 Kolom */
        .board-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
        .board-column { background: #fff; border: 1px solid #64748B; border-radius: 16px; padding: 20px; min-height: 360px; }
        .column-title { text-align: center; font-size: 18px; font-weight: 500; color: #0F172A; margin-bottom: 18px; }

        .service-card { border: 1px solid #64748B; border-radius: 16px; padding: 22px 16px; text-align: center; margin-bottom: 18px; }
        .plate-text { font-size: 16px; font-weight: 600; margin-bottom: 14px; }
        .complaint-text { font-size: 15px; margin-bottom: 16px; }
        .meta-text { font-size: 14px; color: #1E293B; line-height: 1.5; }

        .btn-outline { width: 85%; margin: 18px auto 0; display: block; background: #fff; border: 1px solid #64748B; color: #0F172A; padding: 11px; border-radius: 999px; font-size: 15px; cursor: pointer; }
        .btn-orange-full { width: 85%; margin: 18px auto 0; display: block; background: #FF6500; border: none; color: #fff; padding: 11px; border-radius: 999px; font-size: 15px; cursor: pointer; }
        .btn-navy-full { width: 85%; margin: 18px auto 0; display: block; background: #0B192C; border: none; color: #fff; padding: 11px; border-radius: 999px; font-size: 15px; cursor: pointer; }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div>
            <a href="#" class="brand-logo">WG</a>
            <div class="menu-label">Main Menu</div>
            <a href="#" class="nav-link">Homepage</a>
            <a href="#" class="nav-link">Data Kendaraan</a>
            <a href="{{ route('ui.jadwal') }}" class="nav-link active">Jadwal Service</a>
            <a href="#" class="nav-link">Riwayat Service</a>
            <a href="#" class="nav-link">Layanan Service</a>
            <a href="#" class="nav-link">Sparepart</a>

            <div class="menu-label">Keuangan & Operasional</div>
            <a href="#" class="nav-link">Kasir</a>
            <a href="#" class="nav-link">Transaksi</a>

            <div class="menu-label">Sistem</div>
            <a href="{{ route('ui.users') }}" class="nav-link">User & Staff</a>
            <a href="#" class="nav-link">About Us</a>
        </div>

        <div class="sidebar-footer">
            <div class="avatar-circle">F</div>
            <div>
                <div style="font-weight: 600;">Fitian</div>
                <div style="font-size: 11px; color: #94A3B8;">Service Advisor</div>
            </div>
        </div>
    </aside>

    <div class="main-wrapper">
        <header class="topbar">
            <div class="topbar-title">Will Garage</div>
            <div class="topbar-actions">
                <span class="badge-orange">Bengkel Buka (08.00 - 18.00)</span>
                <span class="badge-orange">Sign Out</span>
            </div>
        </header>

        <main class="content-area">
            <div class="header-row">
                <div class="page-heading">Penjadwalan & Service</div>
                <button type="button" class="btn-navy">+ Booking Jadwal Service</button>
            </div>

            <div class="board-grid">
                <!-- Kolom 1: Menunggu Antrean -->
                <div class="board-column">
                    <div class="column-title">Menunggu Antrean</div>
                    <div class="service-card">
                        <div class="plate-text">D 5678 ABG</div>
                        <div class="complaint-text">Ganti Kampas Rem</div>
                        <div class="meta-text">Pemilik : Siti</div>
                        <div class="meta-text">Mekanik : Bima</div>
                    </div>
                    <button type="button" class="btn-outline" onclick="alert('Status dipindahkan ke Sedang Dikerjakan')">Mulai Kerjakan</button>
                </div>

                <!-- Kolom 2: Sedang Dikerjakan -->
                <div class="board-column">
                    <div class="column-title">Sedang Dikerjakan</div>
                    <div class="service-card">
                        <div class="plate-text">D 5678 ABG</div>
                        <div class="complaint-text">Ganti Kampas Rem</div>
                        <div class="meta-text">Pemilik : Siti</div>
                        <div class="meta-text">Mekanik : Bima</div>
                    </div>
                    <button type="button" class="btn-orange-full" onclick="alert('Status dipindahkan ke Selesai')">Selesai</button>
                </div>

                <!-- Kolom 3: Selesai -->
                <div class="board-column">
                    <div class="column-title">Selesai</div>
                    <div class="service-card">
                        <div class="plate-text">D 5678 ABG</div>
                        <div class="complaint-text">Ganti Kampas Rem</div>
                        <div class="meta-text">Pemilik : Siti</div>
                        <div class="meta-text">Mekanik : Bima</div>
                    </div>
                    <button type="button" class="btn-navy-full" onclick="alert('Diteruskan ke halaman Kasir')">Pembayaran</button>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
