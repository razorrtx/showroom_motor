<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Cepi Anugerah Motor')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS untuk Sidebar menyesuaikan Mockup -->
    <style>
        body { background-color: #f8f9fa; }
        .sidebar {
            width: 250px;
            background-color: #2c3144; /* Warna gelap ungu/biru tua sesuai mockup */
            min-height: 100vh;
            position: fixed;
            display: flex;
            flex-direction: column;
        }
        .sidebar a {
            color: #d1d5db;
            text-decoration: none;
            padding: 15px 20px;
            font-weight: 500;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #1f2333;
            color: #ffffff;
            border-left: 4px solid #0d6efd;
        }
        .sidebar .brand {
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #3f455e;
            margin-bottom: 20px;
        }
        .main-content {
            margin-left: 250px;
            width: calc(100% - 250px);
        }
        .topbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 15px 30px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
        .logout-btn {
            margin-top: auto;
            margin-bottom: 20px;
            padding: 0 20px;
        }
    </style>
</head>
<body>

    <!-- Sidebar Kiri -->
    <div class="sidebar">
        <div class="brand">
            Cepi Anugerah Motor
        </div>
        
        <!-- Menu Navigasi Sesuai Mockup -->
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('admin.kendaraan.index') }}" class="{{ request()->routeIs('admin.kendaraan.index', 'admin.motor.create', 'admin.motor.edit') ? 'active' : '' }}">Data Kendaraan</a>
        <a href="{{ route('admin.spesifikasi.index') }}" class="{{ request()->routeIs('admin.spesifikasi.index') ? 'active' : '' }}">Detail Spesifikasi</a>
        <a href="{{ route('admin.katalog.index') }}" class="{{ request()->routeIs('admin.katalog.index') ? 'active' : '' }}">Kelola Katalog</a>
        <a href="{{ route('admin.kriteria.index') }}" class="{{ request()->routeIs('admin.kriteria.index') ? 'active' : '' }}">Bobot Kriteria SAW</a>

        <!-- Tombol Logout Merah di Bawah -->
        <div class="logout-btn">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger w-100 fw-bold">Logout</button>
            </form>
        </div>
    </div>

    <!-- Area Konten Kanan -->
    <div class="main-content">
        <!-- Topbar Sesuai Mockup -->
        <div class="topbar shadow-sm">
            <div class="d-flex align-items-center">
                <span class="me-2 text-dark">👤 Halo, <strong>{{ Auth::user()->username }}</strong>!</span>
            </div>
        </div>

        <!-- Wadah untuk Konten Dinamis -->
        <div class="p-4">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>