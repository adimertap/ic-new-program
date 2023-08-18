<?php

namespace App\Http\Controllers\Home;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterHeaderKelas;

class UskpReviewController extends Controller
{
    public function index()
    {
        $produk = Produk::where('nama_produk', 'like', 'uskp%')
                    ->where('aktif', '1')
                    ->get();
                    
        $header = MasterHeaderKelas::where('kelas','USKP')->where('section', null)->first();
        $judul = MasterHeaderKelas::where('kelas','USKP')->where('section', 'Judul')->first();

        return view('home.pages.uskp', [
            'produk' => $produk,
            'header' => $header,
            'judul' => $judul
        ]);
    }
}
