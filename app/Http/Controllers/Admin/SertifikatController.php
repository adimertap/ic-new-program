<?php

namespace App\Http\Controllers\Admin;
use Alert;
use App\Models\User;
use App\Models\Produk;
use App\Models\Sertifikat;
use App\Http\Controllers\Controller;
use App\Models\KeranjangProduk;
use App\Models\MasterTandaTangan;
use App\Models\PesertaUjian;
use PDF;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;


function convertToRoman($number) {
    $map = array(
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1
    );

    $result = '';
    foreach ($map as $roman => $value) {
        while ($number >= $value) {
            $result .= $roman;
            $number -= $value;
        }
    }

    return $result;
}

class SertifikatController extends Controller
{
    public function index()
    {
        $sertifikat = Sertifikat::where('request', 1)->get();
        $sertif_lama = Sertifikat::where('request', 2)->get();

        $ttd = MasterTandaTangan::get();
        $ttd_jenis = MasterTandaTangan::where('status', 1)->get();

        return view('admin.pages.master.sertifikat', [
            'sertifikat' => $sertifikat,
            'ttd' => $ttd,
            'ttd_jenis' => $ttd_jenis,
            'sertif_lama' => $sertif_lama
        ]);
    }

    public function requestSertifikat(Request $request)
    {
        try {
            $nourut = KeranjangProduk::selectRaw('MAX(SUBSTRING(no_invoice, 9, 3)) AS no_invoice')->first();
            $invoice = sprintf('%03d', ($nourut['no_invoice'] + 1));
            $bulan = number2roman(date('m'));
            $tahun = date('Y');
            $no_invoice = 'NO. INV-' . $invoice . '/ICEDU/' . $bulan . '/' . $tahun;


            $keranjang = KeranjangProduk::where('id', $request->id_keranjang)->first();
            if($keranjang->status != 2){
                Alert::warning('Gagal', 'Lunasi terlebih dahulu Kelas Pelatihan Ini');
                return redirect()->back();
            }else{
                $produk = Produk::where('slug', $keranjang->slug)->first();
                $find = Sertifikat::where('username',$request->username)->where('slug_product', $keranjang->slug)->first();
                if($find){
                    $nomor = $find->id + 1;
                }else{
                    $nomor = 1;
                }
                $angkatan = convertToRoman($produk->angkatan);
                $nama_produk = strtoupper($produk->nama_produk);
                $currentMonth = date('n');
                $monthInRoman = convertToRoman($currentMonth);
                $tahun = date('Y');
                $nomorsertif = $nomor . "/IC" . "/" . $nama_produk . "-" . $angkatan . "/" . $monthInRoman . "/" . $tahun;

                $sertif = new Sertifikat();
                $sertif->nomor = $nomorsertif;
                $sertif->slug_product = $keranjang->slug;
                $sertif->request = 1;
                $sertif->username = $request->username;
                $sertif->status_bayar = $keranjang->status;
                $sertif->save();
        
                Alert::success('Success', 'Sukses Request Sertifikat, Mohon ditunggu');
                return redirect()->back();
            }

          
        } catch (\Throwable $th) {
            Alert::warning('Warning', 'Internal Server Error, Request Failed');
            return redirect()->back();
        }
      

        // $tes = Sertifikat::where('username', $request->username)->update([
        //     'request' => 1
        // ]);
        // return redirect()->back()->with('success', 'Sukses request sertifikat, Harap ditunggu');
    }

    public function getSertifikat($id)
    {
        $nomorSertifikat = Sertifikat::find($id);
        $user = User::where('username', $nomorSertifikat->username)->first();
        $namaLengkap = $user->name;

        $produk = Produk::where('slug', $nomorSertifikat->slug_product)->first();
        $tglMulai = $produk->tgl_mulai;
        $sertifikat = $produk->sertifikat;

        //sertifikat depan
        $getImage = pathinfo(asset('storage/sertifikat/'.$sertifikat));
        $img = Image::make(public_path('storage/sertifikat/'.$sertifikat));      

		// nama sertifikat
		// $img->text($namaLengkap, 822, 1327, function($font) {
		// 	$font->file(public_path('fonts/Fredoka-Regular.ttf'));
		// 	$font->size(144);
		// 	$font->color('#000');
		// 	$font->valign('top');
		// });

		// $img->text($nomorSertifikat->nomor, 1705, 1058, function($font){
		// 	$font->file(public_path('fonts/GothamMedium.ttf'));
		// 	$font->size(64);
		// 	$font->color('#000');
		// 	$font->valign('top');
		// });

		// $img->text(tgl_indo($tglMulai), 1564, 1766, function($font){
		// 	$font->file(public_path('fonts/GothamMedium.ttf'));
		// 	$font->size(64);
		// 	$font->color('#000');
		// 	$font->valign('top');
		// });
    
		// $filename = $nomorSertifikat->slug_product.'-'.$namaLengkap.".".$getImage['extension'];
		// $pathToFile = public_path('storage/sertifikat/downloaded/'.$filename);

        // $img->save($pathToFile);

        // Storage::disk('unduhSertifikat')->put($filename, $img);
        
		// return response()->download($pathToFile);
    }

    public function getSertifikatNilai($id)
    {
        $nomorSertifikat = Sertifikat::find($id);
        $user = User::where('username', $nomorSertifikat->username)->first();
        $namaLengkap = $user->name;
        $userId = $user->id;

        $produk = Produk::where('slug', $nomorSertifikat->slug_product)->first();
        $sertifikatNilai = $produk->sertifikat_nilai;

        $peserta = PesertaUjian::where('slug_product', $nomorSertifikat->slug_product)
            ->where('user_id', $userId)
            ->orderBy('materi_id', 'ASC')
            ->get();

        //sertifikat belakang
        $getImage = pathinfo(asset('storage/sertifikat/'.$sertifikatNilai));
        $cetakBelakang = Image::make(public_path('storage/sertifikat/'.$sertifikatNilai));

        foreach ($peserta as $key => $value) {
            $cetak_nilai = $value->nilai_angka . ' | ' . $value->nilai_abjad;
            //nomor surat
            // $cetakBelakang->text($nomorSertifikat->nomor, 253, 445, function ($font) {
            //     $font->file(public_path('fonts/GothamMedium.ttf'));
            //     $font->size(32);
            //     $font->color('#000');
            //     $font->valign('top');
            // });
            // //nilai materi pertama (($key != 0) ? (150/$key) : $key)
            // $cetakBelakang->text($cetak_nilai, 1865, 622 + ($key * 78), function ($font) {
            //     $font->file(public_path('fonts/Fredoka-Regular.ttf'));
            //     $font->size(32);
            //     $font->color('#000');
            // });
        }

        $filename = $nomorSertifikat->slug_product . '-' . $namaLengkap . '-nilai.'.$getImage['extension'];
        $pathToFile = public_path('storage/sertifikat/downloaded/'.$filename);

        $cetakBelakang->save($pathToFile);
        
        return response()->download($pathToFile);
    }


    public function sertifikatAdmin(Request $request, $id){
        try {
            $sertif = Sertifikat::where('id', $id)->first();
            $cek = KeranjangProduk::where('slug', $sertif->slug_product)->where('username', $sertif->username)->first();
            $user = User::where('email', $sertif->username)->first();
            $ttd = MasterTandaTangan::where('id_ttd', $sertif->ttd_id)->first();

            // return view('user.pages.sertifikat', compact('user','cek','sertif','ttd'));
            $pdf = PDF::loadView('user.pages.sertifikat', ['user' => $user, 'cek' => $cek, 'sertif' => $sertif, 'ttd' => $ttd]);
            $pdf->getDomPDF()->set_paper('A4', 'landscape'); // Set the paper size and orientation
            $pdf->getDomPDF()->set_option('margin', 0);
            return $pdf->download('Sertifikat' . $user->name . '.pdf');
        } catch (\Throwable $th) {
            dd($th);
            Alert::warning('Warning', 'Internal Server Error, Hubungi Admin');
            return redirect()->back();
        }
    }

    public function sertifikatUlang(Request $request, $id){
        try {
            $sertif = Sertifikat::where('id', $id)->first();
            $sertif->request = 1;
            $sertif->update();

            Alert::success('Success Title', 'Berhasil Reset Tanda Tangan');
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
            Alert::warning('Warning', 'Internal Server Error, Hubungi Admin');
            return redirect()->back();
        }
    }
}
