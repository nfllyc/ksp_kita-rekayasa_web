
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Koperasi Simpan Pinjam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow border-0 p-4" style="width: 420px;">
        <h3 class="text-center mb-2">Koperasi Simpan Pinjam Karya Insan Tangguh Amanah </h3>
        <p class="text-center text-muted">Silakan masuk ke akun Anda</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf

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

            <button type="submit" class="btn btn-primary w-100">
                Login
            </button>
        </form>

        <p class="text-center mt-3 mb-0">
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar sekarang</a>
        </p>
    </div>
</div>

</body>
</html>
