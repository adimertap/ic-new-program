<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = "materi";

	protected $fillable = [
        'id', 'description', 'active','slug', 'created_at', 'updated_at', 'created_by'
    ];

    public function peserta()
    {
        return $this->hasOne(PesertaUjian::class, 'materi_id', 'id');
    }

    /**
     * Get the produk associated with the Materi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function produk()
    {
        return $this->hasOne(Produk::class,'slug','slug');
    }

    /**
     * Get all of the keranjang for the Materi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function keranjang()
    {
        return $this->hasMany(KeranjangProduk::class, 'slug', 'slug');
    }
}
