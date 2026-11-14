<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Anggota;

class Pinjaman extends Model
{
    protected $table = 'pinjamans';

    protected $fillable = [
        'anggota_id',
        'tanggal',
        'jumlah',
        'status',
        'keterangan',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}