
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Pinjaman - Koperasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #F8F5FA; }
        .navbar { background: #A77BC2; }
        .btn-purple { background: #A77BC2; color: white; }
        .btn-purple:hover { background: #6F4A83; color: white; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="navbar-brand fw-bold">
            KSP KITA
        </a>
    </div>
</nav>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <h3 class="fw-bold">Edit Pinjaman</h3>
                    <p class="text-muted">Perbarui transaksi pinjaman anggota.</p>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('pinjaman.update', $pinjaman->id) }}"
                          method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama Anggota</label>
                            <select name="anggota_id" class="form-select" required>
                                @foreach($anggotas as $anggota)
                                    <option value="{{ $anggota->id }}"
                                        {{ old('anggota_id', $pinjaman->anggota_id) == $anggota->id ? 'selected' : '' }}>
                                        {{ $anggota->nomor_anggota }} - {{ $anggota->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Pinjaman</label>
                            <input type="date" name="tanggal" class="form-control"
                                   value="{{ old('tanggal', $pinjaman->tanggal) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jumlah Pinjaman (Rp)</label>
                            <input type="number" name="jumlah" class="form-control"
                                   min="1"
                                   value="{{ old('jumlah', $pinjaman->jumlah) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status Pinjaman</label>
                            <select name="status" class="form-select" required>
                                @foreach(['Menunggu', 'Disetujui', 'Ditolak'] as $status)
                                    <option value="{{ $status }}"
                                        {{ old('status', $pinjaman->status) == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control"
                                      rows="3">{{ old('keterangan', $pinjaman->keterangan) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-purple">
                            Update Pinjaman
                        </button>

                        <a href="{{ route('pinjaman.index') }}"
                           class="btn btn-secondary">
                            Kembali
                        </a>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
