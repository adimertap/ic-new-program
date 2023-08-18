<?php

namespace App\Http\Controllers\Home;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterHeaderKelas;

class SeminarController extends Controller
{
    public function index()
    {
        $produk = Produk::where('nama_produk', 'like', 'seminar%')
                    ->where('aktif', '1')
                    ->get();
        $header = MasterHeaderKelas::where('kelas','Seminar')->where('section', null)->first();
        $judul = MasterHeaderKelas::where('kelas','Seminar')->where('section','Judul')->first();
                    
        return view('home.pages.seminar', [
            'produk' => $produk,
            'header' => $header,
            'judul' => $judul
        ]);
    }
}
