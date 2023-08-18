<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ujian extends Model
{
    use HasFactory;

    protected $table = "ujian";

	protected $fillable = [
        'user_id', 'soal_id','jawaban', 'materi_id', 'benar'
    ];

    /**
     * Get the materi that owns the Ujian
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function soal()
    {
        return $this->belongsTo(BankSoalUjian::class, 'soal_id', 'no_soal');
    }

    /**
     * Get the materi that owns the Ujian
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id', 'id');
    }

    /**
     * Get the user that owns the Ujian
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
