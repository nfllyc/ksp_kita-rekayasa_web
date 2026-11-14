<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AnggotaController extends Controller
{
    // Menampilkan seluruh data anggota
    public function index()
    {
        $anggotas = Anggota::latest()->get();

        return view('anggota.index', compact('anggotas'));
    }

    // Menampilkan formulir tambah anggota
    public function create()
    {
        return view('anggota.create');
    }

    // Menyimpan data anggota
    public function store(Request $request)
    {
        $request->validate([
            'nomor_anggota' => 'required|string|max:30|unique:anggotas',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
        ]);

        Anggota::create([
            'user_id' => Auth::id(),
            'nomor_anggota' => $request->nomor_anggota,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        return redirect()->route('anggota.index')
            ->with('success', 'Data anggota berhasil ditambahkan.');
    }

    // Menampilkan formulir edit anggota
    public function edit(Anggota $anggota)
    {
        return view('anggota.edit', compact('anggota'));
    }

    // Memperbarui data anggota
    public function update(Request $request, Anggota $anggota)
    {
        $request->validate([
            'nomor_anggota' => [
                'required',
                'string',
                'max:30',
                Rule::unique('anggotas')->ignore($anggota->id),
            ],
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
        ]);

        $anggota->update($request->only([
            'nomor_anggota',
            'nama',
            'alamat',
            'telepon',
        ]));

        return redirect()->route('anggota.index')
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    // Menghapus data anggota
    public function destroy(Anggota $anggota)
    {
        $anggota->delete();

        return redirect()->route('anggota.index')
            ->with('success', 'Data anggota berhasil dihapus.');
    }
}
