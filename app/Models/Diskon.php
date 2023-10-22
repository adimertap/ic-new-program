<?php

namespace App\Models;

use App\Models\Kerjasama;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diskon extends Model
{
    use HasFactory;

    protected $table = "master_diskon";
    protected $guarded = ['id'];

    protected $fillable = [
	    'id', 
		'kode', 
		'tgl_mulai', 
		'tgl_selesai', 
		'nilai', 
		'is_active',  
		'created_at',
		'updated_at',
    ];

}
