<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PesertaUjian extends Model
{
    use HasFactory;

    protected $table = "peserta";

    protected $fillable = [
        'user_id', 'materi_id','nilai_angka', 'lulus', 'nilai_abjad', 'slug_product'
    ];
    
    /**
     * Get the user that owns the Peserta
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the materi associated with the Hasil
     *
     * @return \Illumina\Database\Eloquent\Relations\HasOne
     */
    public function materi(): HasOne
    {
        return $this->hasOne(Materi::class, 'id', 'materi_id');
    }
}
