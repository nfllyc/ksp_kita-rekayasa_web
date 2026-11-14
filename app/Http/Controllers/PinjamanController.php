<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\Anggota;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    // Menampilkan daftar transaksi pinjaman
    public function index()
    {
        $pinjamans = Pinjaman::with('anggota')->latest()->get();

        return view('pinjaman.index', compact('pinjamans'));
    }

    // Menampilkan form tambah pinjaman
    public function create()
    {
        $anggotas = Anggota::orderBy('nama')->get();

        return view('pinjaman.create', compact('anggotas'));
    }

    // Menyimpan transaksi pinjaman
    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:1',
            'status' => 'required|in:Menunggu,Disetujui,Ditolak',
            'keterangan' => 'nullable|string',
        ]);

        Pinjaman::create($request->only([
            'anggota_id',
            'tanggal',
            'jumlah',
            'status',
            'keterangan',
        ]));

        return redirect()->route('pinjaman.index')
            ->with('success', 'Transaksi pinjaman berhasil ditambahkan.');
    }

    // Menampilkan form edit pinjaman
    public function edit(Pinjaman $pinjaman)
    {
        $anggotas = Anggota::orderBy('nama')->get();

        return view('pinjaman.edit', compact('pinjaman', 'anggotas'));
    }

    // Memperbarui transaksi pinjaman
    public function update(Request $request, Pinjaman $pinjaman)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:1',
            'status' => 'required|in:Menunggu,Disetujui,Ditolak',
            'keterangan' => 'nullable|string',
        ]);

        $pinjaman->update($request->only([
            'anggota_id',
            'tanggal',
            'jumlah',
            'status',
            'keterangan',
        ]));

        return redirect()->route('pinjaman.index')
            ->with('success', 'Transaksi pinjaman berhasil diperbarui.');
    }

    // Menghapus transaksi pinjaman
    public function destroy(Pinjaman $pinjaman)
    {
        $pinjaman->delete();

        return redirect()->route('pinjaman.index')
            ->with('success', 'Transaksi pinjaman berhasil dihapus.');
    }
}
