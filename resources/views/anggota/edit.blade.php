
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Anggota - Koperasi</title>
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

                    <h3 class="fw-bold mb-2">Edit Anggota</h3>
                    <p class="text-muted">Perbarui informasi anggota koperasi.</p>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('anggota.update', $anggota->id) }}"
                          method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nomor Anggota</label>
                            <input type="text" name="nomor_anggota"
                                   class="form-control"
                                   value="{{ old('nomor_anggota', $anggota->nomor_anggota) }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Anggota</label>
                            <input type="text" name="nama"
                                   class="form-control"
                                   value="{{ old('nama', $anggota->nama) }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control"
                                      rows="3" required>{{ old('alamat', $anggota->alamat) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" name="telepon"
                                   class="form-control"
                                   value="{{ old('telepon', $anggota->telepon) }}"
                                   required>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-purple">
                                Update Anggota
                            </button>

                            <a href="{{ route('anggota.index') }}"
                               class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
