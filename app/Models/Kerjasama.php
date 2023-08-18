<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kerjasama extends Model
{
    use HasFactory;

    protected $table = "master_kerjasama";
    protected $guarded = ['id'];

    protected $fillable = [
        'nama',
        'diskon_online',
        'diskon_angka',
        'status',
        'id_jenis'
    ];


    /**
     * The user that belong to the Kerjasama
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Jenis()
    {
        return $this->belongsTo(MasterJenisInstansi::class, 'id_jenis', 'id_jenis');
    }
}
