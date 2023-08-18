<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrashUsers extends Model
{
    use HasFactory;

    protected $table = "tmp_users";

	// protected $fillable = [
    //     'id', 'image_name', 'name', 'email', 'no_hp', 'pekerjaan', 'username' , 'password', 'role', 'active', 'created_at', 'updated_at'
    // ];

    protected $guarded = [
        'id'
    ];
}
