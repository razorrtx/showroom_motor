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
<body class="bg-white font-[Inter] text-slate-900 antialiased flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="border-b border-slate-300 bg-white sticky top-0 z-50" x-data="{ mobileMenu: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="font-bold text-xl md:text-2xl tracking-tight text-black">
                        Cepi Anugerah Motor
                    </a>
                </div>
                
                <!-- Menu Desktop -->
                <div class="hidden md:flex space-x-8 h-full items-center">
                    <a href="{{ url('/katalog') }}" class="text-base font-medium h-full flex items-center {{ request()->is('katalog') ? 'border-b-2 border-black text-black' : 'text-slate-600 hover:text-black' }}">
                        Katalog Motor
                    </a>
                    <a href="{{ url('/rekomendasi') }}" class="text-base font-medium h-full flex items-center {{ request()->is('rekomendasi') ? 'border-b-2 border-black text-black' : 'text-slate-600 hover:text-black' }}">
                        Fitur rekomendasi SAW
                    </a>
                </div>

                <!-- Tombol Login Desktop -->
                <div class="hidden md:flex items-center">
                    <a href="{{ route('login') }}" class="flex items-center text-base font-medium text-slate-700 hover:text-black">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        Login Admin
                    </a>
                </div>

                <!-- Hamburger Mobile -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenu = !mobileMenu" class="text-slate-900 focus:outline-none">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Menu Mobile Dropdown -->
        <div x-show="mobileMenu" class="md:hidden border-t border-slate-200 bg-white" style="display: none;">
            <div class="px-4 pt-2 pb-4 space-y-2">
                <a href="{{ url('/katalog') }}" class="block px-3 py-2 text-base font-medium text-black bg-slate-50 rounded">Katalog Motor</a>
                <a href="{{ url('/rekomendasi') }}" class="block px-3 py-2 text-base font-medium text-slate-600 hover:text-black rounded">Fitur rekomendasi SAW</a>
                <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-slate-600 hover:text-black rounded border-t border-slate-200 mt-2">Login Admin</a>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="grow">
        @yield('content')
    </main>

    <!-- Footer Sesuai Mockup -->
    <footer class="bg-white border-t border-slate-300 mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                <div class="flex items-start gap-4">
                    <svg class="w-8 h-8 text-black shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <p class="text-base text-black">Pasir Biru, Kec. Rancakalong,<br>Kabupaten Sumedang, Jawa<br>Barat</p>
                </div>
                <div class="flex items-start gap-4">
                    <svg class="w-8 h-8 text-black shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-base text-black">Jam Buka:<br>Sen - Min<br>(06.00 - 20.00)</p>
                </div>
                <div class="flex items-start gap-4">
                    <!-- Placeholder icon WA sederhana (outline) -->
                    <svg class="w-8 h-8 text-black shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    <p class="text-base text-black">082318413915<br>(Tanya Unit)</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>