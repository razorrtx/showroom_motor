<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Cepi Anugerah Motor</title>
    @vite('resources/css/app.css')
    <!-- Font Inter untuk kesan profesional -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-100 font-[Inter] flex items-center justify-center min-h-screen">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-8 border border-slate-50">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-slate-800">Login Admin</h1>
            <p class="text-sm text-slate-500 mt-2 tracking-wide uppercase">Cepi Anugerah Motor</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 text-red-600 text-sm p-4 rounded-xl mb-6 border border-red-100">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Username</label>
                <input type="text" name="username" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" placeholder="Masukkan username..." required autofocus>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
                <input type="password" name="password" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" placeholder="••••••••" required>
            </div>

            <button type="submit" class="w-full py-3.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all mt-6">
                Masuk ke Panel
            </button>
        </form>
        
        <div class="mt-8 text-center border-t border-slate-100 pt-6">
            <a href="{{ route('katalog') }}" class="text-sm text-slate-500 hover:text-blue-600 font-medium transition-colors">&larr; Kembali ke Katalog Publik</a>
        </div>
    </div>

</body>
</html>