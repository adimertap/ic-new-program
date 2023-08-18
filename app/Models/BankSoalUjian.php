<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankSoalUjian extends Model
{
    use HasFactory;

    protected $table = "soal_ujian";

	protected $fillable = [
        'no_soal', 'soal', 'a', 'b', 'c', 'd','jawaban','pembahasan','image_pembahasan','materi_id', 'kode_soal',
    ];

    /**
     * Get the materi that owns the Ujian
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function materi(): BelongsTo
    {
        return $this->belongsTo(Materi::class, 'materi_id', 'id');
    }
}
