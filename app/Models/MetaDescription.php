<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaDescription extends Model
{
    use HasFactory;

    protected $table = "meta_description";

    protected $guarded = ['id'];

    protected $fillable = [
        'pages',
        'title',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public $timestamps = true;
}
