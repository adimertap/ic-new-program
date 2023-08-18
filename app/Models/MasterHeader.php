<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterHeader extends Model
{
    protected $table = "master_header_pages";

    protected $primaryKey = 'id_header';

    protected $fillable = [
        'pages',
        'section',
        'description',
        'section_2',
        'section_3'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public $timestamps = true;

    
}
