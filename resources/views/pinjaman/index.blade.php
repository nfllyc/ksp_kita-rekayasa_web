
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Pinjaman - Koperasi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #F8F5FA;
        }

        .navbar {
            background: #A77BC2;
        }

        .btn-purple {
            background: #A77BC2;
            color: white;
        }

        .btn-purple:hover {
            background: #6F4A83;
            color: white;
        }

        .card {
            border: none;
            border-radius: 12px;
        }

        thead {
            background: #EDE3F5;
        }

        .table th,
        .table td {
            vertical-align: middle;
            white-space: nowrap;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-dark">
        <div class="container">
            <a href="{{ route('dashboard') }}" class="navbar-brand fw-bold">
                KSP KITA
            </a>

            <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm">
                Dashboard
            </a>
        </div>
    </nav>

    <div class="container mt-4">

        <!-- Judul dan Tombol -->
        <div class="mb-4">
            <h3 class="fw-bold mb-1">Data Pinjaman</h3>

            <p class="text-muted mb-3">
                Kelola transaksi pinjaman anggota koperasi.
            </p>

            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('laporan.pinjaman') }}"
                   target="_blank"
                   class="btn btn-danger">
                    Cetak PDF
                </a>

                <a href="{{ route('pinjaman.create') }}"
                   class="btn btn-purple">
                    + Tambah Pinjaman
                </a>
            </div>
        </div>

        <!-- Notifikasi -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Pinjaman -->
        <div class="card shadow-sm">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-3">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Anggota</th>
                                <th>Tanggal</th>
                                <th>Jumlah Pinjaman</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($pinjamans as $pinjaman)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $pinjaman->anggota->nama }}</td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($pinjaman->tanggal)->format('d-m-Y') }}
                                    </td>

                                    <td>
                                        Rp {{ number_format($pinjaman->jumlah, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        @if($pinjaman->status == 'Disetujui')
                                            <span class="badge bg-success">
                                                Disetujui
                                            </span>
                                        @elseif($pinjaman->status == 'Ditolak')
                                            <span class="badge bg-danger">
                                                Ditolak
                                            </span>
                                        @else
                                            <span class="badge bg-warning text-dark">
                                                Menunggu
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $pinjaman->keterangan ?? '-' }}
                                    </td>

                                    <td>
                                        <a href="{{ route('pinjaman.edit', $pinjaman->id) }}"
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('pinjaman.destroy', $pinjaman->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        Belum ada transaksi pinjaman.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                <!-- Jumlah Transaksi -->
                <p class="text-muted mb-0">
                    Jumlah transaksi:
                    <strong>{{ $pinjamans->count() }}</strong>
                </p>

            </div>
        </div>

    </div>

</body>
</html>
