<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MetaDescription;
use Illuminate\Http\Request;
use Alert;

class MetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meta = MetaDescription::get();
        return view('admin.pages.master.meta', compact('meta'));
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
            $check = MetaDescription::where('pages', $request->pages)->first();
            if(!$check){
                $meta = new MetaDescription();
                $meta->pages = $request->pages;
                $meta->title = $request->title;
                $meta->save();
            }else{
                Alert::warning('Warning', 'Meta Title Tersebut Telah Ada, Edit jika terdapat perubahan');
                return redirect()->back();
            }

            Alert::success('Success', 'Data Meta Title Berhasil Ditambahkan');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::warning('Warning', 'Internal Server Error');
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
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $check = MetaDescription::where('id', $id)->first();
        if($check){
            return $check;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_meta)
    {
        try {
            $check = MetaDescription::where('id', $request->id_meta)->first();
            if($check){
                $item = MetaDescription::find($request->id_meta);
                $item->title = $request->title;
                $item->update();
            }else{
                Alert::warning('Warning', 'Meta Title Tidak Ditemukan');
                return redirect()->back();
            }
    
            Alert::success('Success', 'Data Meta Title Berhasil DiUpdate');
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
            Alert::warning('Warning', 'Internal Server Error');
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
            $check = MetaDescription::where('id', $id)->first();
            if($check){
                $check->delete();
            }else{
                Alert::warning('Warning', 'Meta Title tidak ditemukan');
                return redirect()->back();
            }

            Alert::success('Success', 'Data Meta Title Berhasil Dihapus');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::warning('Warning', 'Internal Server Error');
            return redirect()->back();
        }
    }
}
