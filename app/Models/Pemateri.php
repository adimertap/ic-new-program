<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pemateri extends Model
{
    use HasFactory;

    protected $table = "pemateri";

	protected $guarded = ['id'];

    /**
     * Get the user associated with the Pemateri
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Get the materi associated with the Pemateri
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function materi(): HasOne
    {
        return $this->hasOne(Materi::class, 'id', 'materi_id');
    }

    /**
     * Get all of the soal for the Pemateri
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function soal(): HasMany
    {
        return $this->hasMany(BankSoal::class, 'kode_soal','kode_soal');
    }
}
