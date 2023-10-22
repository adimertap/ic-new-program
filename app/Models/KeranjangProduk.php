<?php

namespace App\Models;

use App\Models\User;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KeranjangProduk extends Model
{
    use HasFactory;

    protected $table = "keranjang_produk";

	protected $fillable = [
	    'id', 
		'username', 
		'status', 
		'diskon', 
		'slug', 
		'sertifikat',  
		'no_invoice', 
		'aktif', 
		'payment_status',
		'tenor',
		'sisaTenor',
		'type_pembayaran',
		'midtrans_url',
		'midtrans_url_cicilan',
		'midtrans_booking_code',
		'total_price',
		'id_kelas',
		'harga_kelas',
		'id_instansi',
		'cicilan_temp_idr',
		'data',
		'created_at',
		'updated_at',
		'voucher_text_id',
		'harga_kelas_after_disc'
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

	public function Kelas(): BelongsTo
	{
		return $this->belongsTo(Produk::class, 'id_kelas', 'id');
	}

	public function Instansi(): BelongsTo
	{
		return $this->belongsTo(Kerjasama::class, 'id_instansi', 'id');
	}

	public function Voucher(): BelongsTo
	{
		return $this->belongsTo(Diskon::class, 'voucher_text_id', 'id');
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

  /**
   * Get the user associated with the KeranjangProduk
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function diskon(): HasOne
  {
      return $this->hasOne(Diskon::class, 'kode', 'kode_voucher');
  }
}
