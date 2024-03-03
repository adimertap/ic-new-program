<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MidtransHistory extends Model
{
    use HasFactory;

    protected $table = "keranjang_midtrans_history";

    protected $guarded = ['history_id'];

    protected $fillable = [
        'keranjang_id',
        'status',
        'payload_json',
        'order_id',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public $timestamps = true;

    public function Keranjang()
    {
        return $this->belongsTo(KeranjangProduk::class, 'keranjang_id', 'id');
    }
}
