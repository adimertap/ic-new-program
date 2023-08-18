<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterTandaTangan;
use Illuminate\Http\Request;
use Alert;
use App\Models\KeranjangProduk;
use App\Models\Sertifikat;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use PDF;
use Illuminate\Support\Facades\Mail;

class TandaTanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
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
            $ttd = New MasterTandaTangan();
            $ttd->keterangan = $request->keterangan;
            $ttd->jenis = 'ttd';
            $ttd->status = 1;
            if ($request->hasFile('gambar')) {
                $imagePath = $request->file('gambar');
                $imageName = $imagePath->getClientOriginalName();
                $imagePath->move(public_path().'/tandatangan/', $imageName); 
                $data[] = $imageName;
                $ttd->gambar = $imageName;
            }
            $ttd->save();

            Alert::success('Success Title', 'Data Berhasil Ditambahkan');
            return redirect()->back();

        } catch (\Throwable $th) {
            Alert::warning('Error', 'Internal Server Error, Try Refreshing The Page');
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
            $ttd = MasterTandaTangan::find($id);
            return $ttd;
        } catch (\Throwable $th) {
            return $th;
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
            $tes = Sertifikat::where('id', $request->id_sertif_ttd)->first();
            $tes->ttd_id = $request->ttd_pilih;
            $tes->request = 2;
            $tes->update();
            $user = User::where('email', $tes->username)->first();

            $data = array();
            $data['email'] = $tes->username;
            $data['subject'] = 'Sertifikat IC Education';
            $data['nama'] = $user->name;

            $cek = KeranjangProduk::with('Kelas')->where('slug', $tes->slug_product)->where('username', $tes->username)->first();
            $user = User::where('email', $cek->username)->first();
            $ttd = MasterTandaTangan::where('id_ttd', $tes->ttd_id)->first();
            $pdf = PDF::loadView('user.pages.sertifikat', ['user' => $user, 'cek' => $cek, 'sertif' => $tes, 'ttd' => $ttd]);
            $pdf->setPaper('A4', 'portrait');
          
            try {
                Mail::send('mail-sertif', $data, function ($message) use ($data, $pdf) {
                    $message->to($data["email"])
                        ->subject($data['subject'])
                        // ->cc(['adimertap@gmail.com','adimerta@student.unud.ac.id'])
                        ->cc(['info@iceducation.co.id'])
                        ->attachData($pdf->output(), "sertifikat.pdf");
                });

                // Mail::send('mail-sertif', $data, function ($message) use ($data) {
                // $message->to($data["email"], $data["nama"])
                //     ->subject($data["subject"])
                //     ->cc(['info@iceducation.co.id']);
                // });
            } catch (JWTException $exception) {
                $serverstatuscode = "0";
                $serverstatusdes = $exception->getMessage();
            }

            Alert::success('Success Title', 'Berhasil Tanda Tangani Sertifikat');
            return redirect()->back();

        } catch (\Throwable $th) {
            return $th;
            Alert::warning('Error', 'Internal Server Error, Try Refreshing The Page');
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
            $ttd = MasterTandaTangan::find($id);
            $imageName = $ttd->gambar;
            if ($imageName && Storage::exists('tandatangan/' . $imageName)) {
                Storage::delete('tandatangan/' . $imageName);
            }
            $ttd->delete();

            Alert::success('Success Title', 'Data Berhasil Dihapus');
            return redirect()->back();

        } catch (\Throwable $th) {
            Alert::warning('Error', 'Internal Server Error, Try Refreshing The Page');
            return redirect()->back();
        }
    }
}
