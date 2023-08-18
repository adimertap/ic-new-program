<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankSoalUjian;
use App\Models\Materi;
use App\Models\Produk;
use Illuminate\Http\Request;

class UjianController extends Controller
{
    public function bankSoal()
    {
        $bankSoal = BankSoalUjian::all();
        $materi = Materi::all();
        return view('admin.pages.ujian.bank-soal', [
            'bankSoal' => $bankSoal,
            'materi' => $materi,
        ]);
    }

    public function storeSoal(Request $request)
    {
        $request->validate([
            'no_soal' => 'required',
            'materi_id' => 'required',
            'kode_soal' => 'required|string',
            'soal' => 'required|string',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'jawaban' => 'required',
            'pembahasan' => 'required',
        ]);

        $newSoal = $request->except(['id', '_token']);

        BankSoalUjian::updateOrCreate(['id' => $request->input('id')], $newSoal);
        return redirect()->route('admin-ujian-bank-soal')->with('success', 'Added New Soal');
    }

    public function destroySoal($id)
    {
        BankSoalUjian::destroy($id);
        return redirect()->route('admin-ujian-bank-soal')->with('success', 'Deleted Soal');
    }

    public function aksesUjian()
    {
        $product = Produk::where('nama_produk', 'like', 'brevet%')
                        ->where('aktif', '1')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('admin.pages.ujian.akses-ujian', [
            'products' => $product
        ]);
    }

    public function tahapPertama(Request $request)
    {
        Produk::where('slug', $request->slug)->update([
            'akses_ujian' => '1'
        ]);

        return redirect()->route('admin-ujian-akses-ujian')->with('success', $request->slug.' Akses Tahap Pertama');
    }

    public function tahapKedua(Request $request)
    {
        Produk::where('slug', $request->slug)->update([
            'akses_ujian' => '2'
        ]);

        return redirect()->route('admin-ujian-akses-ujian')->with('success', $request->slug.' Akses Tahap Kedua');
    }

    public function tutupAkses(Request $request)
    {
        Produk::where('slug', $request->slug)->update([
          'akses_ujian' => '0'
        ]);

        return redirect()->route('admin-ujian-akses-ujian')->with('success', 'Akses ujian berhasil ditutup');
    }

    public function editSoal($id)
    {
      $soal = BankSoalUjian::find($id);
      return response()->json($soal);
    }
}
