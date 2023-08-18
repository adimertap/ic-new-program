<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\MasterHeaderKelas;
use App\Models\Produk;
use Illuminate\Http\Request;

class BrevetController extends Controller
{
    public function index(Request $request)
    {
        $produk = Produk::where('nama_produk', 'like', 'brevet-%')
                    ->where('aktif', '1')
                    ->get();
        $header = MasterHeaderKelas::where('kelas','Brevet')->where('section', null)->first();
        $judul = MasterHeaderKelas::where('kelas','Brevet')->where('section','Judul')->first();
        return view('home.pages.brevet', [
            'produk' => $produk,
            'header' => $header,
            'judul' => $judul
        ]);
    }
}
