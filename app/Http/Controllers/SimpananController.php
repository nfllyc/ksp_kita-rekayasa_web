<?php

namespace App\Http\Controllers;

use App\Models\Simpanan;
use App\Models\Anggota;
use Illuminate\Http\Request;

class SimpananController extends Controller
{
    // Menampilkan daftar transaksi simpanan
    public function index()
    {
        $simpanans = Simpanan::with('anggota')->latest()->get();

        return view('simpanan.index', compact('simpanans'));
    }

    // Menampilkan form tambah simpanan
    public function create()
    {
        $anggotas = Anggota::orderBy('nama')->get();

        return view('simpanan.create', compact('anggotas'));
    }

    // Menyimpan transaksi simpanan
    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:1',
            'keterangan' => 'nullable|string',
        ]);

        Simpanan::create($request->only([
            'anggota_id',
            'tanggal',
            'jumlah',
            'keterangan',
        ]));

        return redirect()->route('simpanan.index')
            ->with('success', 'Transaksi simpanan berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit(Simpanan $simpanan)
    {
        $anggotas = Anggota::orderBy('nama')->get();

        return view('simpanan.edit', compact('simpanan', 'anggotas'));
    }

    // Memperbarui transaksi
    public function update(Request $request, Simpanan $simpanan)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:1',
            'keterangan' => 'nullable|string',
        ]);

        $simpanan->update($request->only([
            'anggota_id',
            'tanggal',
            'jumlah',
            'keterangan',
        ]));

        return redirect()->route('simpanan.index')
            ->with('success', 'Transaksi simpanan berhasil diperbarui.');
    }

    // Menghapus transaksi
    public function destroy(Simpanan $simpanan)
    {
        $simpanan->delete();

        return redirect()->route('simpanan.index')
            ->with('success', 'Transaksi simpanan berhasil dihapus.');
    }
}
