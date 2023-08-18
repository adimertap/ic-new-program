<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterTenagaPendidik;
use Illuminate\Http\Request;
use Alert;
use App\Models\MasterJenisInstansi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
// use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class TenagaPendidikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $pendidik = MasterTenagaPendidik::get();
            return view('admin.pages.master.tenagapendidik', compact('pendidik'));
        } catch (\Throwable $th) {
            dd($th);
            Alert::warning('Error', 'Internal Server Error, Try Refreshing The Page');
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
                'nama_pendidik' => ['required','string','min:6'],
                'photo_profile' => ['image','mimes:png,jpg,jpeg']
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                Alert::warning('Error', implode("<br>", $errors));
                return redirect()->back();
            }else{
                $check = MasterTenagaPendidik::where('nama_pendidik', $request->nama_pendidik)->first();
                if($check){
                    Alert::warning('Error','Data Tenaga Pendidik Sudah Ada');
                    return redirect()->back();
                }else{
                    $item = new MasterTenagaPendidik();
                    $item->nama_pendidik = $request->nama_pendidik;
                    $item->pendidikan_1 = $request->pendidikan_1;
                    $item->pendidikan_2 = $request->pendidikan_2;
                    $item->pendidikan_3 = $request->pendidikan_3;
                    $item->pendidikan_4 = $request->pendidikan_4;
                    $item->pendidikan_5 = $request->pendidikan_5;
                    $item->pendidikan_6 = $request->pendidikan_6;
                    $item->pengalaman_1 = $request->pengalaman_1;
                    $item->pengalaman_2 = $request->pengalaman_2;
                    $item->pengalaman_3 = $request->pengalaman_3;
                    $item->pengalaman_4 = $request->pengalaman_4;
                    $item->pengalaman_5 = $request->pengalaman_5;
                    $item->pengalaman_6 = $request->pengalaman_6;
                    $item->status = '1';
                    if ($request->hasFile('image')) {
                        $imagePath = $request->file('image');
                        $imageName = $imagePath->getClientOriginalName();
                        $imagePath->move(public_path().'/pendidik/', $imageName); 
                        $data[] = $imageName;
                        $item->photo_profile = $imageName;
                    }
                   
                    $item->save();
    
                    Alert::success('Success Title', 'Data Tenaga Pendidik Berhasil Ditambahkan');
                    return redirect()->back();
                }
            }
        } catch (\Throwable $th) {
            dd($th);
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
    public function show(Request $request, $id)
    {
        try {
            $item = MasterTenagaPendidik::find($id);
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
                'nama_pendidik' => ['required','string','min:6'],
                'photo_profile' => ['image','mimes:png,jpg,jpeg']
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                Alert::warning('Error', implode("<br>", $errors));
                return redirect()->back();
            }else{
                $item = MasterTenagaPendidik::find($request->id_pendidik);
                $item->nama_pendidik = $request->nama_pendidik;
                $item->pendidikan_1 = $request->pendidikan_1;
                $item->pendidikan_2 = $request->pendidikan_2;
                $item->pendidikan_3 = $request->pendidikan_3;
                $item->pendidikan_4 = $request->pendidikan_4;
                $item->pendidikan_5 = $request->pendidikan_5;
                $item->pendidikan_6 = $request->pendidikan_6;
                $item->pengalaman_1 = $request->pengalaman_1;
                $item->pengalaman_2 = $request->pengalaman_2;
                $item->pengalaman_3 = $request->pengalaman_3;
                $item->pengalaman_4 = $request->pengalaman_4;
                $item->pengalaman_5 = $request->pengalaman_5;
                $item->pengalaman_6 = $request->pengalaman_6;
                if ($request->hasFile('image')) {
                    $imagePath = $request->file('image');
                    $imageName = $imagePath->getClientOriginalName();
                    $imagePath->move(public_path().'/pendidik/', $imageName); 
                    $data[] = $imageName;
                    $item->photo_profile = $imageName;
                }
                // if ($request->hasFile('image')) {
                //     $newImage = $request->file('image');
                //     $newImageName = Str::random(10) . '.' . $newImage->getClientOriginalExtension();
                //     Storage::disk('folderPendidik')->put($newImageName, file_get_contents($newImage));
                //     $item->photo_profile = $newImageName;
                // }
                $item->save();

                Alert::success('Success Title', 'Data Tenaga Pendidik Berhasil Diupdate');
                return redirect()->back();
                
            }
        } catch (\Throwable $th) {

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
            $item = MasterTenagaPendidik::find($id);
            $item->delete();

            Alert::success('Success Title', 'Data Tenaga Pendidik Berhasil Terhapus');
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
            Alert::warning('Warning', 'Internal Server Error');
            return redirect()->back();
        }
    }

    public function aktif(Request $request, $id)
    {

        try {
            $item = MasterTenagaPendidik::findOrFail($id);
            $item->status = $request->has('is_active') ? '1' : '0';
            $item->save();
    
            if($item->status == '1'){
                Alert::success('Sukses', 'Tenaga Pendidik Berhasil diaktifkan');
            }else{
                Alert::success('Sukses', 'Tenaga Pendidik Berhasil Dinonaktifkan');
            }
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('Error', 'Internal Server Error');
            return redirect()->back();
        }
    }
}
