
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Koperasi Simpan Pinjam</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #F8F5FA;
        }

        .navbar {
            background-color: #A77BC2;
        }

        .card-menu {
            border: none;
            border-radius: 12px;
            transition: 0.2s;
        }

        .card-menu:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 18px rgba(0,0,0,0.10);
        }

        .icon-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: #EDE3F5;
            color: #6F4A83;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            margin-bottom: 15px;
        }

        .btn-purple {
            background-color: #A77BC2;
            color: white;
        }

        .btn-purple:hover {
            background-color: #6F4A83;
            color: white;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            KSP KITA
        </a>

        <div class="ms-auto d-flex align-items-center gap-3">
            <span class="text-white">
                Halo, {{ Auth::user()->name }}
            </span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-light btn-sm">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="container py-5">

    <div class="mb-4">
        <h3 class="fw-bold">Dashboard</h3>
        <p class="text-muted">
            Selamat datang di KOPERASI SIMPAN DAN PINJAM KITA (Karya Insan Tangguh Amanah).
        </p>
        <P>
            Kelola data anggota dan transaksi koperasi melalui menu berikut.
        </P>
    </div>

    <div class="row g-4">

        <!-- Data Anggota -->
        <div class="col-md-4">
            <div class="card card-menu shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="icon-box">👥</div>

                    <h5 class="fw-bold">Data Anggota</h5>

                    <p class="text-muted">
                        Mengelola informasi anggota koperasi,
                        mulai dari tambah, edit, lihat, hingga hapus data.
                    </p>

                    <a href="{{ route('anggota.index') }}"
                       class="btn btn-purple w-100">
                        Kelola Anggota
                    </a>
                </div>
            </div>
        </div>

        <!-- Data Simpanan -->
        <div class="col-md-4">
            <div class="card card-menu shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="icon-box">💰</div>

                    <h5 class="fw-bold">Data Simpanan</h5>

                    <p class="text-muted">
                        Mengelola transaksi simpanan anggota
                        dan mencatat jumlah uang yang disimpan.
                    </p>

                    <a href="{{ route('simpanan.index') }}"
                    class="btn btn-purple w-100">
                            Kelola Simpanan
                    </a>
                </div>
            </div>
        </div>

        <!-- Data Pinjaman -->
        <div class="col-md-4">
            <div class="card card-menu shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="icon-box">💳</div>

                    <h5 class="fw-bold">Data Pinjaman</h5>

                    <p class="text-muted">
                        Mengelola transaksi pinjaman anggota
                        dan memantau status pinjaman.
                    </p>


                <a href="{{ route('pinjaman.index') }}"
                    class="btn btn-purple w-100">
                    Kelola Pinjaman
                </a>

                </div>
            </div>
        </div>

    </div>

    <div class="mt-5 text-center text-muted">
        <small>
            © 2026 Koperasi Simpan Pinjam. All Rights Reserved.
        </small>
    </div>

</div>

</body>
</html>
