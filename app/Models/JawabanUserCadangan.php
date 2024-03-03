<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JawabanUserCadangan extends Model
{
    use HasFactory;

    protected $table = "jawaban_temp_cadangan";
    protected $primaryKey = 'jawaban_cd_id';
	protected $fillable = [
	    'user_id', 
		'soal_id', 
        'materi_id',
		'jawaban_user', 
    ];

	protected $hidden =[ 
        'created_at',
        'updated_at',
        
    ];

    public function user(): BelongsTo
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

    public function soal(): BelongsTo
	{
		return $this->belongsTo(BankSoalUjian::class, 'soal_id', 'id');
	}

    public function materi(): BelongsTo
	{
		return $this->belongsTo(Materi::class, 'materi_id', 'id');
	}


}
