<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = "master_produk";

	protected $fillable = [
        'kelas',
        'nama_produk',
        'harga',
        'diskon',
        'tgl_mulai',
        'tgl_selesai',
        'jam_mulai',
        'jam_selesai',
        'note',
        'aktif',
        'gratis',
        'slug', 
        'created_at', 
        'updated_at',
        'created_by',
        'description', 
        'akses_ujian', 
        'sertifikat', 
        'sertifikat_nilai',
        'angkatan', 
        'online'
    ];
}
