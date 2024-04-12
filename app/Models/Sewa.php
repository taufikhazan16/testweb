<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    use HasFactory;
    protected $table = 'sewa'; // Menentukan nama tabel
    protected $fillable = [
        'tanggal_masuk',
        'tanggal_selesai',
        'biaya_sewa',
        'keterangan',
        'mobil_id',
        'pengguna_id',
        'status_sewa',
    ];
}
