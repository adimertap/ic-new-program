<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJenisInstansi extends Model
{
    protected $table = "master_jenis_kerjasama";

    protected $primaryKey = 'id_jenis';

    protected $fillable = [
        'jenis',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public $timestamps = true;
}
