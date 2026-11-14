
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi | Koperasi Simpan Pinjam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow border-0 p-4" style="width: 420px;">
        <h3 class="text-center mb-2">Buat Akun</h3>
        <p class="text-center text-muted">Daftar akun koperasi Anda</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.process') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control"
                       value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password"
                       class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                       class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Daftar
            </button>
        </form>

        <p class="text-center mt-3 mb-0">
            Sudah punya akun?
            <a href="{{ route('login') }}">Login</a>
        </p>
    </div>
</div>

</body>
</html>

