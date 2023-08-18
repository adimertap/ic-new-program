<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produk;
use App\Models\Sertifikat;
use Illuminate\Http\Request;
use App\Models\KeranjangProduk;
use App\Models\NomorSertifikat;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProdukController extends Controller
{
    public function index()
    {
        $products = Produk::orderBy('updated_at', 'desc')->get();

        return view('admin.pages.master.produk', [
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required',
            'harga' => 'required',
            'diskon' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'note' => 'required',
            'nama_produk' => 'required',
            'angkatan' => 'required',
            'online' => 'required',
        ]);

        $newProduct = $request->except(['id', '_token']);
        $isOnline = $request->online == 1 ? '-online' : '';
        $slug = $request->input('nama_produk').'-'.slug($request->input('kelas')).'-'.slug($request->input('tgl_mulai').$isOnline);
        $newProduct['slug'] = $slug;
        $newProduct['akses_ujian'] = 0;

        $addOrUpdate = Produk::updateOrCreate(['id' => $request->input('id')], $newProduct);
        if ($addOrUpdate) {

            if ($request->input('aktif') == '0'){
                Produk::where('slug', $slug)
                    ->update([
                        'akses_ujian' => '0'
                    ]);
            }

            if ($request->input('slug') != $slug) {
                KeranjangProduk::where('slug', $request->input('slug'))->update([
                    'slug' => $slug
                ]);
            }

            return redirect()->route('admin-produk')->with('success', $request->input('id') !== null ? $slug.' '.'Edited' : $slug.' '.'Stored');
        }

        return redirect()->route('admin-produk')->with('error', $request->input('id') !== null ? $slug.' '.'Edited' : $slug.' '.'Stored');
    }

    public function edit($id)
    {
        $products = Produk::find($id);
        return response()->json($products);
    }

    public function destroy($id)
    {
        Produk::destroy($id);
        return redirect()->route('admin-produk')->with('success', 'Product Deleted');
    }

    public function addSertifikatProduct(Request $request)
    {
        $request->validate([
            'sertifikat' => 'required|image|mimes:jpeg,png,jpg',
            'sertifikat_nilai' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $produk = Produk::find($request->id);

        $angkatan = ($produk->angkatan) ? $produk->nama_produk.'-'.number2roman($produk->angkatan) : $produk->nama_produk;
		    $files = $request->sertifikat;
		    $files_nilai = $request->sertifikat_nilai;

        if ($files && $files_nilai) {
          $sertifikat = $produk->slug.'.'. $files->getClientOriginalExtension();
          $sertifikat_nilai = $produk->slug.'-nilai'.'.'. $files_nilai->getClientOriginalExtension();
          Storage::disk('sertifikat')->put($sertifikat, file_get_contents($files));
          Storage::disk('sertifikat')->put($sertifikat_nilai, file_get_contents($files_nilai));

        $produk->update([
				'sertifikat' => $sertifikat,
				'sertifikat_nilai' => $sertifikat_nilai
			]);

			$keranjang = KeranjangProduk::where('slug', $produk->slug)
                            ->where('status', '2')
                            ->pluck('username');
                            
			$bulan = now()->isoFormat('M');
			$tahun = now()->isoFormat('YYYY');

			$no = NomorSertifikat::where('produk', $produk->nama_produk)->value('nomor_surat');

			if ($no) {
				$nomor_surat = $no;
			} else {
				$nomor_surat = 1;
			}

			foreach ($keranjang as $username) {
				$nomor = $nomor_surat.'/IC/'.$angkatan.'/'.number2roman($bulan).'/'.$tahun;
				Sertifikat::create([
					'nomor' => $nomor,
					'slug_product' => $produk->slug,
					'username' => $username
				]);
				$nomor_surat ++;
			}

			if ($no) {
				NomorSertifikat::where('produk', $produk->nama_produk)->update([
					'nomor_surat' => $nomor_surat,
				]);
			} else {
				NomorSertifikat::create([
					'nomor_surat' => $nomor_surat,
					'produk' => $produk->nama_produk
				]);
			}

            return redirect()->route('admin-sertifikat')->with('success', 'Certificate Number is Generated');
        }
    }
}