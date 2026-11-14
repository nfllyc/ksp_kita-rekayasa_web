
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Pinjaman - Koperasi</title>
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

                    <h3 class="fw-bold">Tambah Pinjaman</h3>
                    <p class="text-muted">Masukkan transaksi pinjaman anggota.</p>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('pinjaman.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Anggota</label>
                            <select name="anggota_id" class="form-select" required>
                                <option value="">-- Pilih Anggota --</option>
                                @foreach($anggotas as $anggota)
                                    <option value="{{ $anggota->id }}"
                                        {{ old('anggota_id') == $anggota->id ? 'selected' : '' }}>
                                        {{ $anggota->nomor_anggota }} - {{ $anggota->nama }}
                                    </option>
                                @endforeach
                            </select>

                            @if($anggotas->isEmpty())
                                <small class="text-danger">
                                    Tambahkan anggota terlebih dahulu.
                                </small>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Pinjaman</label>
                            <input type="date" name="tanggal" class="form-control"
                                   value="{{ old('tanggal', date('Y-m-d')) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jumlah Pinjaman (Rp)</label>
                            <input type="number" name="jumlah" class="form-control"
                                   min="1" value="{{ old('jumlah') }}"
                                   placeholder="Contoh: 500000" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status Pinjaman</label>
                            <select name="status" class="form-select" required>
                                <option value="Menunggu"
                                    {{ old('status', 'Menunggu') == 'Menunggu' ? 'selected' : '' }}>
                                    Menunggu
                                </option>
                                <option value="Disetujui"
                                    {{ old('status') == 'Disetujui' ? 'selected' : '' }}>
                                    Disetujui
                                </option>
                                <option value="Ditolak"
                                    {{ old('status') == 'Ditolak' ? 'selected' : '' }}>
                                    Ditolak
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control"
                                      rows="3">{{ old('keterangan') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-purple"
                            {{ $anggotas->isEmpty() ? 'disabled' : '' }}>
                            Simpan Pinjaman
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
