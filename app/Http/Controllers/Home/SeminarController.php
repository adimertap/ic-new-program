<?php

namespace App\Http\Controllers\Home;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterHeaderKelas;
use App\Models\MetaDescription;

class SeminarController extends Controller
{
    public function index(Request $request)
    {
        $produk = Produk::where('nama_produk', 'like', 'seminar%')
            ->where('aktif', '1');
        if ($request->jenis) {
            if ($request->jenis == 'online') {
                $produk->where('online', '1');
            } else if ($request->jenis == 'offline') {
                $produk->where('online', '0');
            } else{
            }
        }
        $produk = $produk->get();
        $meta = MetaDescription::where('pages', 'Seminar')->first();

        $header = MasterHeaderKelas::where('kelas', 'Seminar')->where('section', null)->first();
        $judul = MasterHeaderKelas::where('kelas', 'Seminar')->where('section', 'Judul')->first();

        return view('home.pages.seminar', [
            'produk' => $produk,
            'header' => $header,
            'judul' => $judul,
            'meta' => $meta
        ]);
    }
}
