<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Simpanan;
use App\Models\Pinjaman;
use FPDF;

class LaporanController extends Controller
{
    // Mengubah teks UTF-8 agar dapat dibaca FPDF
    private function teks($text)
    {
        return iconv('UTF-8', 'ISO-8859-1//TRANSLIT', (string) $text);
    }

    // Membuat judul laporan
    private function judul($pdf, $judul)
    {
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, $this->teks($judul), 0, 1, 'C');

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(
            0,
            8,
            $this->teks('Tanggal Cetak: ' . date('d-m-Y H:i')),
            0,
            1,
            'C'
        );

        $pdf->Ln(5);
    }

    // Mengatur tampilan header tabel
    private function headerTabel($pdf, $kolom)
    {
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(237, 227, 245);
        $pdf->SetTextColor(53, 43, 59);

        foreach ($kolom as $item) {
            $pdf->Cell($item[1], 10, $this->teks($item[0]), 1, 0, 'C', true);
        }

        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetTextColor(0, 0, 0);
    }

    // Laporan data anggota
    public function anggota()
    {
        $data = Anggota::with('user')->orderBy('nama')->get();

        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->AddPage();

        $this->judul($pdf, 'LAPORAN DATA ANGGOTA KOPERASI');

        $this->headerTabel($pdf, [
            ['No', 12],
            ['Nomor Anggota', 35],
            ['Nama Anggota', 45],
            ['Alamat', 105],
            ['Telepon', 35],
            ['Pengguna', 45],
        ]);

        foreach ($data as $index => $anggota) {
            $pdf->Cell(12, 9, $index + 1, 1, 0, 'C');
            $pdf->Cell(35, 9, $this->teks($anggota->nomor_anggota), 1);
            $pdf->Cell(45, 9, $this->teks($anggota->nama), 1);
            $pdf->Cell(105, 9, $this->teks($anggota->alamat), 1);
            $pdf->Cell(35, 9, $this->teks($anggota->telepon), 1);
            $pdf->Cell(
                45,
                9,
                $this->teks($anggota->user->name ?? '-'),
                1
            );
            $pdf->Ln();
        }

        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(0, 10, $this->teks('Jumlah Data Anggota: ' . $data->count()));

        $pdf->Output('I', 'laporan-anggota.pdf');
        exit;
    }

    // Laporan transaksi simpanan
    public function simpanan()
    {
        $data = Simpanan::with('anggota')->orderBy('tanggal')->get();

        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->AddPage();

        $this->judul($pdf, 'LAPORAN TRANSAKSI SIMPANAN');

        $this->headerTabel($pdf, [
            ['No', 12],
            ['Nomor Anggota', 35],
            ['Nama Anggota', 50],
            ['Tanggal', 35],
            ['Jumlah (Rp)', 45],
            ['Keterangan', 100],
        ]);

        foreach ($data as $index => $simpanan) {
            $pdf->Cell(12, 9, $index + 1, 1, 0, 'C');
            $pdf->Cell(35, 9, $this->teks($simpanan->anggota->nomor_anggota ?? '-'), 1);
            $pdf->Cell(50, 9, $this->teks($simpanan->anggota->nama ?? '-'), 1);
            $pdf->Cell(35, 9, date('d-m-Y', strtotime($simpanan->tanggal)), 1);
            $pdf->Cell(45, 9, number_format($simpanan->jumlah, 0, ',', '.'), 1, 0, 'R');
            $pdf->Cell(100, 9, $this->teks($simpanan->keterangan ?? '-'), 1);
            $pdf->Ln();
        }

        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(0, 10, $this->teks('Jumlah Transaksi: ' . $data->count()));

        $pdf->Output('I', 'laporan-simpanan.pdf');
        exit;
    }

    // Laporan transaksi pinjaman
    public function pinjaman()
    {
        $data = Pinjaman::with('anggota')->orderBy('tanggal')->get();

        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->AddPage();

        $this->judul($pdf, 'LAPORAN TRANSAKSI PINJAMAN');

        $this->headerTabel($pdf, [
            ['No', 12],
            ['Nomor Anggota', 35],
            ['Nama Anggota', 45],
            ['Tanggal', 35],
            ['Jumlah (Rp)', 40],
            ['Status', 35],
            ['Keterangan', 85],
        ]);

        foreach ($data as $index => $pinjaman) {
            $pdf->Cell(12, 9, $index + 1, 1, 0, 'C');
            $pdf->Cell(35, 9, $this->teks($pinjaman->anggota->nomor_anggota ?? '-'), 1);
            $pdf->Cell(45, 9, $this->teks($pinjaman->anggota->nama ?? '-'), 1);
            $pdf->Cell(35, 9, date('d-m-Y', strtotime($pinjaman->tanggal)), 1);
            $pdf->Cell(40, 9, number_format($pinjaman->jumlah, 0, ',', '.'), 1, 0, 'R');
            $pdf->Cell(35, 9, $this->teks($pinjaman->status), 1);
            $pdf->Cell(85, 9, $this->teks($pinjaman->keterangan ?? '-'), 1);
            $pdf->Ln();
        }

        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(0, 10, $this->teks('Jumlah Transaksi: ' . $data->count()));

        $pdf->Output('I', 'laporan-pinjaman.pdf');
        exit;
    }
}
