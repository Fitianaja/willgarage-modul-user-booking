<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna & Staf - Will Garage</title>
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
        .btn-navy:hover { background-color: #132640; }

        /* User Cards */
        .user-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .user-card { background: #fff; border: 1px solid #64748B; border-radius: 14px; padding: 20px 22px; display: flex; justify-content: space-between; align-items: center; }
        .user-name { font-weight: 700; font-size: 15px; color: #0F172A; }
        .user-email { font-size: 12px; color: #64748B; margin-top: 2px; }
        .user-role { font-weight: 700; font-size: 13px; color: #0B192C; margin-top: 12px; }
        .user-icon { width: 44px; height: 44px; border-radius: 50%; border: 2px solid #FF6500; color: #FF6500; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 18px; }

        /* Form Box */
        .form-panel { display: none; background: #fff; border: 1px solid #64748B; border-radius: 14px; padding: 20px; margin-bottom: 22px; }
        .form-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-top: 12px; }
        .form-control { width: 100%; padding: 9px 12px; border: 1px solid #94A3B8; border-radius: 8px; font-size: 13px; }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div>
            <a href="#" class="brand-logo">WG</a>
            <div class="menu-label">Main Menu</div>
            <a href="#" class="nav-link">Homepage</a>
            <a href="#" class="nav-link">Data Kendaraan</a>
            <a href="{{ route('ui.jadwal') }}" class="nav-link">Jadwal Service</a>
            <a href="#" class="nav-link">Riwayat Service</a>
            <a href="#" class="nav-link">Layanan Service</a>
            <a href="#" class="nav-link">Sparepart</a>

            <div class="menu-label">Keuangan & Operasional</div>
            <a href="#" class="nav-link">Kasir</a>
            <a href="#" class="nav-link">Transaksi</a>

            <div class="menu-label">Sistem</div>
            <a href="{{ route('ui.users') }}" class="nav-link active">User & Staff</a>
            <a href="#" class="nav-link">About Us</a>
        </div>

        <div class="sidebar-footer">
            <div class="avatar-circle">F</div>
            <div>
                <div style="font-weight: 600;">Fitian</div>
                <div style="font-size: 11px; color: #94A3B8;">Admin</div>
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
                <div class="page-heading">Manajemen Pengguna & Staf</div>
                <div style="display: flex; gap: 10px;">
                    <button type="button" class="btn-navy" onclick="toggleForm()">&#9998; Edit Data User</button>
                    <button type="button" class="btn-navy" onclick="toggleForm()">+ Tambah Data User</button>
                </div>
            </div>

            <div id="userFormPanel" class="form-panel">
                <strong style="color: #0B192C;">Form Tambah / Edit Pengguna & Staf (Simulasi UI)</strong>
                <div class="form-grid">
                    <input type="text" placeholder="Nama Lengkap" class="form-control">
                    <input type="email" placeholder="Email" class="form-control">
                    <select class="form-control">
                        <option>Admin</option>
                        <option>Kepala Mekanik / SA</option>
                        <option>Montir</option>
                        <option>Kasir POS</option>
                    </select>
                    <button type="button" class="btn-navy" onclick="alert('Tampilan berhasil disimulasikan!'); toggleForm();">Simpan Data</button>
                </div>
            </div>

            <div class="user-grid">
                <div class="user-card">
                    <div>
                        <div class="user-name">Burhan</div>
                        <div class="user-email">Burhan@gmail.com</div>
                        <div class="user-role">Admin</div>
                    </div>
                    <div class="user-icon">&#128100;</div>
                </div>

                <div class="user-card">
                    <div>
                        <div class="user-name">Wildan</div>
                        <div class="user-email">Wildan@gmail.com</div>
                        <div class="user-role">Kepala Mekanik</div>
                    </div>
                    <div class="user-icon">&#128100;</div>
                </div>

                <div class="user-card">
                    <div>
                        <div class="user-name">Rena</div>
                        <div class="user-email">Rena@gmail.com</div>
                        <div class="user-role">Kasir POS</div>
                    </div>
                    <div class="user-icon">&#128100;</div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function toggleForm() {
            const panel = document.getElementById('userFormPanel');
            panel.style.display = panel.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</body>
</html>
