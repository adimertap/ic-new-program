<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTenagaPendidik extends Model
{
    protected $table = "master_tenaga_pendidik";

    protected $primaryKey = 'id_pendidik';

    protected $fillable = [
        'nama_pendidik',
        'riwayat_pendidikan',
        'pengalaman_kerja',
        'status',
        'photo_profile',
        'pengalaman_1',
        'pengalaman_2',
        'pengalaman_3',
        'pengalaman_4',
        'pengalaman_5',
        'pengalaman_6',
        'pendidikan_1',
        'pendidikan_2',
        'pendidikan_3',
        'pendidikan_4',
        'pendidikan_5',
        'pendidikan_6',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public $timestamps = true;

}
