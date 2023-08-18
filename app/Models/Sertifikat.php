<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    protected $table = "master_sertifikat";

    protected $guarded = ['id'];

    protected $fillable = [
        'slug_product',
        'nomor',
        'username',
        'request',
        'status_bayar',
        'ttd_id'
    ];

}
