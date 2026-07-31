<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Cepi Anugerah Motor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-secondary d-flex align-items-center justify-content-center" style="height: 100vh;">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header text-center bg-primary text-white">
                    <h3 class="font-weight-light my-2">Login Admin</h3>
                    <p class="mb-0">Showroom Cepi Anugerah Motor</p>
                </div>
                <div class="card-body p-4">
                    
                    <!-- Menampilkan Pesan Error Jika Login Gagal -->
                    @if($errors->any())
                        <div class="alert alert-danger pb-0">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('login.proses') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input class="form-control" id="username" name="username" type="text" placeholder="Masukkan Username" value="{{ old('username') }}" required autofocus />
                            <label for="username">Username</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input class="form-control" id="password" name="password" type="password" placeholder="Masukkan Password" required />
                            <label for="password">Password</label>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg" type="submit">Login</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <a href="{{ route('katalog') }}" class="text-decoration-none">← Kembali ke Halaman Publik</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>