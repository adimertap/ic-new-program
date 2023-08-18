<?php

namespace App\Models;

use App\Models\User;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrashKeranjangProduk extends Model
{
    use HasFactory;

    protected $table = "tmp_keranjang_produk";

	protected $fillable = [
		'id', 'username', 'status', 'diskon', 'slug', 'sertifikat', 'aktif',  'note',   'no_invoice', 'created_at', 'updated_at'
    ];

    /**
	 * Get the user that owns the KeranjangProduk
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class, 'username', 'username');
	}

	/**
	 * Get the produk associated with the KeranjangProduk
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function produk(): BelongsTo
	{
		return $this->belongsTo(Produk::class, 'slug', 'slug');
	}
}
