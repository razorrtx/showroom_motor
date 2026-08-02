<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Admin - Cepi Anugerah Motor')</title>
    
    <!-- Memuat Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Inter & Alpine.js untuk Animasi Sidebar Mobile -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-50 font-[Inter] text-slate-800 antialiased" x-data="{ sidebarOpen: false }">

    <!-- Latar Belakang Gelap (Overlay) saat sidebar terbuka di HP -->
    <div x-show="sidebarOpen" class="fixed inset-0 z-20 bg-slate-900/50 lg:hidden" x-transition.opacity @click="sidebarOpen = false" style="display: none;"></div>

    <!-- Sidebar Kiri Sesuai Mockup -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 bg-slate-900 text-white transition-transform duration-300 lg:translate-x-0 lg:static lg:inset-0 shadow-xl flex flex-col">
        
        <!-- Logo / Judul Showroom -->
        <div class="flex items-center justify-center h-16 border-b border-slate-800">
            <span class="text-base font-bold tracking-wider uppercase">Cepi Anugerah</span>
        </div>

        <!-- Menu Navigasi -->
        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.kendaraan.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.kendaraan.index', 'admin.motor.create', 'admin.motor.edit') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                Data Kendaraan
            </a>
            <a href="{{ route('admin.spesifikasi.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.spesifikasi.index') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                Detail Spesifikasi
            </a>
            <a href="{{ route('admin.katalog.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.katalog.index') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                Kelola Katalog
            </a>
            <a href="{{ route('admin.kriteria.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.kriteria.index') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                Bobot Kriteria SAW
            </a>
        </nav>

        <!-- Tombol Logout -->
        <div class="p-4 border-t border-slate-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center px-4 py-2 bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white rounded-lg text-sm font-medium transition-colors">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Area Konten Kanan -->
    <div class="flex-1 flex flex-col min-h-screen overflow-hidden">
        
        <!-- Topbar Sesuai Mockup -->
        <header class="flex items-center justify-between h-16 px-6 bg-white border-b border-slate-200">
            <!-- Tombol Hamburger untuk HP -->
            <button @click="sidebarOpen = true" class="text-slate-500 hover:text-slate-700 focus:outline-none lg:hidden">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
            
            <!-- Sapaan Admin -->
            <div class="flex items-center ml-auto">
                <span class="text-sm font-medium text-slate-600 mr-3">Halo, <strong>Admin!</strong></span>
                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm">
                    A
                </div>
            </div>
        </header>

        <!-- Wadah Konten Dinamis -->
        <main class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8">
            @yield('content')
        </main>
    </div>

</body>
</html>