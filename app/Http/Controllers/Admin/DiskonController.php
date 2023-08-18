<?php

namespace App\Http\Controllers\Admin;

use App\Models\Diskon;
use App\Models\Kerjasama;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiskonController extends Controller
{
    public function index()
    {
      $diskon = Diskon::all();
      $instansi = Kerjasama::all();

      return view('admin.pages.master.diskon', [
        'diskon' => $diskon,
        'instansi' => $instansi,
      ]);
    }

    public function createDiskon(Request $request)
    {
      $request->validate([
        'kode' => 'required',
        'price' => 'required',
      ]);

      $newVoucher = $request->except(['id']);
      $newVoucher['kode'] = $request->input('kode');
      $newVoucher['kerjasama_id'] = $request->input('kerjasama');
      $newVoucher['nilai'] = $request->price;
      $newVoucher['is_active'] = 0;
      $newVoucher['tgl_mulai'] = $request->input('tgl_mulai');
      $newVoucher['selesai'] = $request->input('tgl_selesai');

      $storeData = Diskon::create($newVoucher);
      if ($storeData) {
        return redirect()->route('admin-diskon')->with('success', 'Kode voucher berhasil dibuat');
      }

      return redirect()->route('admin-diskon')->with('error', 'Kode voucher gagal dibuat');
    }

    public function toggleActive(Request $request) {
      $voucher = Diskon::find($request->voucherId);
      $voucher->is_active = $request->status;
      $voucher->save();

      return response()->json(['success' => 'Status voucher berhasil dirubah']);
    }
}
