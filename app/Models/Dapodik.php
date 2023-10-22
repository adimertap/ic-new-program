<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dapodik extends Model
{
    use HasFactory;

    protected $table = "data_dapodik";

	protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'nama_lengkap', 
        'nik', 
        'jenis_kelamin', 
        'tempat_lahir', 
        'tanggal_lahir', 
        'nama_ibu' , 
        'user_id', 
        'created_at', 
        'updated_at', 
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
