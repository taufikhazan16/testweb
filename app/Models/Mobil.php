<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;
    protected $table = 'mobil'; // Menentukan nama tabel

    protected $fillable = [
        'nama_mobil',
        'kapasitas_duduk',
        'warna',
        'nomor_plat',
        'bulan_plat',
        'tahun_plat',
        'bahan_bakar',
        'merek_id',
        'model',
        'harga_sewa',
        'gambar',
    ];
}
