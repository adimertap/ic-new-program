<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTandaTangan extends Model
{
    protected $table = "master_tandatangan";

    protected $primaryKey = 'id_ttd';

    protected $fillable = [
        'keterangan',
        'gambar',
        'status',
        'jenis'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public $timestamps = true;
}
