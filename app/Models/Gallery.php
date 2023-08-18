<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = "gallery";

	protected $fillable = [
        'caption', 'title', 'image', 'active' , 'created_by', 'created_at', 'updated_at'
    ];
}
