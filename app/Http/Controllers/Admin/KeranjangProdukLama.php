<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KeranjangProduk;
use App\Models\Kerjasama;
use App\Models\Produk;
use Illuminate\Http\Request;

class KeranjangProdukLama extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instansi = Kerjasama::join('keranjang_produk','master_kerjasama.id','keranjang_produk.id_instansi')
        ->join('master_jenis_kerjasama','master_kerjasama.id_jenis','master_jenis_kerjasama.id_jenis')
        ->selectRaw('master_kerjasama.id, keranjang_produk.type_pembayaran, nama, jenis, COUNT(no_invoice) as jumlah_keranjang')
        ->where('keranjang_produk.data', '')->OrWhere('keranjang_produk.data', null)
        ->groupBy('nama','jenis','id','type_pembayaran')
        ->get();
    
        return view('admin.pages.keranjangLama.keranjang-instansi-lama',compact('instansi'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $products = KeranjangProduk::
        with(['produk', 'Instansi'])
        ->where('keranjang_produk.data', '')->OrWhere('keranjang_produk.data', null)
        ->where('id_instansi', $id);
        if($request->filterKelas){
          $products->where('slug', $request->filterKelas);
        }
        if($request->filterStatus){
          if($request->filterStatus == 'Pending'){
              $products->where('status', 1);
          }else{
              $products->where('tenor', $request->filterStatus)->where('status', '!=', 1);
          }
        }
        $products = $products->orderBy('keranjang_produk.created_at', 'desc')->get();
        $count = $products->count();

        $instansi = Kerjasama::where('id', $id)->first();
        $activeProducts = Produk::where('aktif', '1')->get();

        return view('admin.pages.keranjangLama.keranjang-produk-lama', [
          'products' => $products,
          'active' => $activeProducts,
          'instansi' => $instansi,
          'count' => $count
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
