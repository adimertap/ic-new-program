<?php

namespace App\Http\Controllers\Home;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterHeaderKelas;
use App\Models\MetaDescription;

class UskpReviewController extends Controller
{
    public function index(Request $request)
    {
        $produk = Produk::where('nama_produk', 'like', 'uskp%')
            ->where('aktif', '1');
        if ($request->jenis) {
            if ($request->jenis == 'online') {
                $produk->where('online', '1');
            } else if ($request->jenis == 'offline') {
                $produk->where('online', '0');
            } else {
            }
        }
        $produk = $produk->get();

        $header = MasterHeaderKelas::where('kelas', 'USKP')->where('section', null)->first();
        $judul = MasterHeaderKelas::where('kelas', 'USKP')->where('section', 'Judul')->first();
        $meta = MetaDescription::where('pages', 'USKP')->first();

        return view('home.pages.uskp', [
            'produk' => $produk,
            'header' => $header,
            'judul' => $judul,
            'meta' => $meta

        ]);
    }
}
