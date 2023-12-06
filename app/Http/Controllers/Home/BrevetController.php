<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\MasterHeaderKelas;
use App\Models\MetaDescription;
use App\Models\Produk;
use Illuminate\Http\Request;

class BrevetController extends Controller
{
    public function index(Request $request)
    {
        $produk = Produk::where('nama_produk', 'like', 'brevet-%')
            ->where('aktif', '1');
        if ($request->jenis) {
            if ($request->jenis == 'online') {
                $produk->where('online', '1');
            } else if ($request->jenis == 'offline') {
                $produk->where('online', '0');
            }
        }
        $produk = $produk->get();
        $meta = MetaDescription::where('pages', 'Brevet')->first();
        $header = MasterHeaderKelas::where('kelas', 'Brevet')->where('section', null)->first();
        $judul = MasterHeaderKelas::where('kelas', 'Brevet')->where('section', 'Judul')->first();
        return view('home.pages.brevet', [
            'produk' => $produk,
            'header' => $header,
            'judul' => $judul,
            'meta' => $meta
        ]);
    }
}
