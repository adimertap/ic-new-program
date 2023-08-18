<?php

namespace App\Models;

use App\Models\Kerjasama;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diskon extends Model
{
    use HasFactory;

    protected $table = "master_diskon";
    protected $guarded = ['id'];

    /**
     * Get the user that owns the Diskon
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the user associated with the Diskon
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kerjasama(): HasOne
    {
        return $this->hasOne(Kerjasama::class, 'id', 'kerjasama_id');
    }
}
