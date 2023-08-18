<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kerjasama;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterJenisInstansi;
use Alert;
use Illuminate\Support\Facades\Validator;

class KerjasamaController extends Controller
{
    public function index()
    {
      try {
        $instansi = Kerjasama::whereNotIn('id', ['6'])->get();
        $jenis = MasterJenisInstansi::get();

        return view('admin.pages.master.kerjasama', [
          'instansi' => $instansi,
          'jenis' => $jenis
        ]);
      } catch (\Throwable $th) {
        Alert::warning('Warning', 'Internal Server Error, Data Not Found');
        return redirect()->back();
      } 
    }

    public function show(Request $request, $id)
    {
      try {
          $item = Kerjasama::find($id);
          return $item;
      } catch (\Throwable $th) {
          Alert::warning('Warning', 'Internal Server Error, Data Not Found');
          return redirect()->back();
      }
    }

    public function create(Request $request)
    {
        try {
          $validator = Validator::make($request->all(), [
              'id_jenis' => ['required'],
              'nama' => ['required', 'string', 'min:4'],
              'status' => ['required']
          ]);

          if ($validator->fails()) {
              $errors = $validator->errors()->all();
              Alert::warning('Error', implode("<br>", $errors));
              return redirect()->back();
          }else{
            $check = Kerjasama::where('nama', $request->nama)->first();
            if($check){
                Alert::warning('Error','Data Jenis Sudah Ada');
                return redirect()->back();
            }else{
                $item = new Kerjasama();
                $item->status = $request->status;
                $item->id_jenis = $request->id_jenis;
                $item->nama = $request->nama;
                $item->diskon_online = $request->diskon_online;
                $item->diskon_angka = $request->diskon_angka;
                $item->save();

                Alert::success('Success Title', 'Data Instansi Berhasil Ditambahkan');
                return redirect()->back();
            }
          }
      } catch (\Throwable $th) {
          Alert::warning('Warning', 'Internal Server Error, Data Not Found');
          return redirect()->back();
      }
    }

    public function update(Request $request)
    {
      try {
        $validator = Validator::make($request->all(), [
            'id_jenis' => ['required'],
            'nama' => ['required', 'string', 'min:4'],
            'status' => ['required']
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            Alert::warning('Error', implode("<br>", $errors));
            return redirect()->back();
        }else{
         
            $item = Kerjasama::find($request->id_instansi);
            $item->status = $request->status;
            $item->id_jenis = $request->id_jenis;
            $item->nama = $request->nama;
            $item->diskon_online = $request->diskon_online;
            $item->diskon_angka = $request->diskon_angka;
            $item->update();

            Alert::success('Success Title', 'Data Instansi Berhasil Ditambahkan');
            return redirect()->back();
          
        }
    } catch (\Throwable $th) {
        Alert::warning('Warning', 'Internal Server Error, Data Not Found');
        return redirect()->back();
    }
    }

    public function delete($id)
    {
        $instansi = Kerjasama::find($id);

        try {
            $instansi->delete();
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal Menghapus '.$th);
        }
    }
}
