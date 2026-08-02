<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cepi Anugerah Motor')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-50 font-[Inter] text-slate-800 antialiased flex flex-col min-h-screen">

    <!-- Navbar Publik -->
    <nav class="bg-white shadow-sm sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="shrink-0 flex items-center gap-2">
                        <span class="font-bold text-lg tracking-tight text-slate-900 hidden sm:block">Cepi Anugerah Motor</span>
                    </a>
                </div>
                
                <!-- Menu Desktop -->
                <!-- Catatan: Sesuaikan nama route() di bawah ini jika error -->
                <div class="hidden sm:flex sm:items-center sm:space-x-8">
                    <!-- Nanti rute '/' kita ganti dengan nama rute welcome jika ada -->
                    <a href="{{ url('/katalog') }}" class="text-sm font-medium border-b-2 border-blue-600 text-blue-600 py-5">Katalog Motor</a>
                    <!-- Nanti rute saw.form kita sesuaikan dengan rute aslimu -->
                    <a href="{{ url('/rekomendasi') }}" class="text-sm font-medium text-slate-500 hover:text-blue-600 transition-colors">Cari Rekomendasi</a>
                </div>

                <!-- Tombol Login Admin (Desktop) -->
                <div class="hidden sm:flex sm:items-center">
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-lg transition-colors">
                        Login Admin
                    </a>
                </div>

                <!-- Hamburger Button (Mobile) -->
                <div class="flex items-center sm:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-slate-500 hover:text-blue-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" style="display: none;"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Menu Mobile (Terbuka saat diklik di HP) -->
        <div x-show="mobileMenuOpen" class="sm:hidden border-t border-slate-100 bg-white" style="display: none;" x-transition>
            <div class="pt-2 pb-4 space-y-1">
                <a href="{{ url('/katalog') }}" class="block px-4 py-2.5 text-base font-medium text-blue-600 bg-blue-50">Katalog Motor</a>
                <a href="{{ url('/rekomendasi') }}" class="block px-4 py-2.5 text-base font-medium text-slate-600 hover:text-blue-600 hover:bg-slate-50">Cari Rekomendasi</a>
                <div class="px-4 mt-4 border-t border-slate-100 pt-4">
                    <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2.5 bg-slate-800 text-white font-medium rounded-lg">Login Admin</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Area Konten Utama Publik -->
    <main class="grow">
        @yield('content')
    </main>

    <!-- Footer Publik -->
    <footer class="bg-slate-900 border-t border-slate-800 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <p class="text-slate-400 text-sm font-medium">
                    &copy; {{ date('Y') }} Cepi Anugerah Motor. Hak Cipta Dilindungi.
                </p>
            </div>
        </div>
    </footer>

</body>
</html>