<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterJenisInstansi;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Validator;

class JenisInstansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $jenis = MasterJenisInstansi::get();
            return view('admin.pages.master.jenisinstansi', compact('jenis'));
        } catch (\Throwable $th) {
            Alert::warning('Warning', 'Internal Server Error, Data Not Found');
            return redirect()->back();
        }
       
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
        try {
            $validator = Validator::make($request->all(), [
                'jenis' => ['required','string'],
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                Alert::warning('Error', implode("<br>", $errors));
                return redirect()->back();
            }else{
                $check = MasterJenisInstansi::where('jenis', $request->jenis)->first();
                if($check){
                    Alert::warning('Error','Data Jenis Sudah Ada');
                    return redirect()->back();
                }else{
                    $item = new MasterJenisInstansi();
                    $item->jenis = $request->jenis;
                    $item->save();
    
                    Alert::success('Success Title', 'Data Jenis Berhasil Ditambahkan');
                    return redirect()->back();
                }
            }
        } catch (\Throwable $th) {
            Alert::warning('Warning', 'Internal Server Error, Data Not Found');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $item = MasterJenisInstansi::find($id);
            return $item;
        } catch (\Throwable $th) {
            Alert::warning('Warning', 'Internal Server Error, Data Not Found');
            return redirect()->back();
        }
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
        try {
            $validator = Validator::make($request->all(), [
                'jenis' => ['required','string'],
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                Alert::warning('Error', implode("<br>", $errors));
                return redirect()->back();
            }else{
                $item = MasterJenisInstansi::find($request->id_jenis_instansi);
                $item->jenis = $request->jenis;
                $item->update();

                Alert::success('Success Title', 'Data Jenis Berhasil Diupdate');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            Alert::warning('Warning', 'Internal Server Error, Data Not Found');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $item = MasterJenisInstansi::find($id);
            $item->delete();

            Alert::success('Success Title', 'Data Jenis Berhasil Terhapus');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::warning('Warning', 'Internal Server Error');
            return redirect()->back();
        }
    }
}
