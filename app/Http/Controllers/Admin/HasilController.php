<?php

namespace App\Http\Controllers\Admin;

// use App\Models\Hasil;
use App\Models\PesertaUjian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HasilController extends Controller
{
    public function index()
    {
      $user = auth()->user()->id;
      $hasil_ujian = PesertaUjian::all();

      return view('admin.pages.ujian.hasil-ujian', [
        'user' => $user,
        'hasil_ujian' => $hasil_ujian,
      ]); 
    }

    public function delete($id)
  {
        try {
            PesertaUjian::destroy($id);

            return redirect()->route('admin-hasil-peserta')->with('success' ,'Berhasil Menghapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal Menghapus '.$th);
        }
  }
}
