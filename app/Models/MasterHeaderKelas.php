<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterHeaderKelas extends Model
{
    protected $table = "master_header_kelas";

    protected $primaryKey = 'id_header_kelas';

    protected $fillable = [
        'kelas',
        'section',
        'description_1',
        'description_2',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public $timestamps = true;
}
