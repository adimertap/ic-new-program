<?php

namespace App\Http\Controllers\User;

use Alert;
use App\Http\Controllers\Controller;
use App\Models\Dapodik;
use App\Models\KeranjangProduk;
use App\Models\MasterTandaTangan;
use App\Models\Materi;
use App\Models\PesertaUjian;
use App\Models\Produk;
use App\Models\Sertifikat;
use App\Models\User;
// use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Str;
use Midtrans\Config;
use PDF;


class DashboardController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = "SB-Mid-server-ThmSXotcqD9A6m7KSd-SIaEG";
        Config::$isProduction = false;
        Config::$isSanitized = false;
        Config::$is3ds = false;
    }

    public function dashboard(Request $request)
    {
        $cekBrevet = KeranjangProduk::with('produk')
            ->where('username', auth()->user()->username)
            ->where('slug', 'like', 'brevet-ab%')
            ->whereIn('status', ['2', '4'])->latest()
            ->first();

        $tr = KeranjangProduk::with('Kelas')->where('username', Auth::user()->username)->get()->take(5);
        $data_dapodik = Dapodik::where('user_id', auth()->user()->id)->first();
        $instansi = User::where('kerjasama_id', auth()->user()->kerjasama_id)->first();

        // return $res;
        return view('user.pages.dashboard', [
            'cekBrevet' => $cekBrevet,
            'transaksi' => $tr,
            'dapodik' => $data_dapodik,
            'instansi' => $instansi,
        ]);
    }

    public function profile(Request $request)
    {
        $cekBrevet = KeranjangProduk::with('produk')
            ->where('username', auth()->user()->username)
            ->where('slug', 'like', 'brevet-ab%')
        // ->whereIn('tenor', ['50','75', 'Full'])->latest()
            ->whereIn('status', ['2', '4'])->latest()
            ->first();

        $data = User::where('id', Auth::user()->id)->first();
        $data_dapodik = Dapodik::where('user_id', auth()->user()->id)->first();

        return view('user.pages.profile', [
            'cekBrevet' => $cekBrevet,
            'data' => $data,
            'dapodik' => $data_dapodik,
        ]);
    }

    public function dataDapodik(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'nik' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        Dapodik::updateOrCreate(
            [
                'user_id' => auth()->user()->id,
            ],
            [
                'user_id' => auth()->user()->id,
                'nama_lengkap' => $request->nama_lengkap,
                'nik' => $request->nik,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'nama_ibu' => $request->nama_ibu,
            ]
        );

        return redirect()->back()->with('success', 'Data Dapodik sudah di update');
    }

    public function hasilUjian(Request $request)
    {
        // return $request;
        $request->session()->forget('hasil');
        $request->session()->forget('abjad');
        $request->session()->forget('lulus');

        $reqSertifikat = Sertifikat::where('username', Auth::user()->username)->value('request');

        $cek = KeranjangProduk::with('produk')
            ->where('username', auth()->user()->username)
            ->where('slug', 'like', 'brevet-ab%')
        // ->whereIn('tenor', ['50', '75', 'Full'])
            ->whereIn('status', ['2', '4'])
            ->latest();
        // ->get();
        // return $cek;

        $cekBrevet = $cek->first();
        $slug = $cek->value('slug');

        $data_dapodik = Dapodik::where('user_id', auth()->user()->id)->first();

        $filename = $slug . '-' . Auth::user()->name . '.jpg';
        $image = File::exists(public_path('storage/sertifikat/downloaded/' . $filename));
        $filename_nilai = $slug . '-' . Auth::user()->name . '-nilai.png';
        $image_nilai = File::exists(public_path('storage/sertifikat/downloaded/' . $filename_nilai));

        if ($slug) {
            // return $slug;
            $materi = Materi::query()
                ->with(['peserta' => function ($query) use ($slug) {
                    $query->where('user_id', auth()->user()->id);
                    $query->where('slug_product', $slug);
                }])
                ->get();

            $lulus = [];
            foreach ($materi as $value) {
                if ($value->peserta && $value->peserta->lulus == 'Lulus') {
                    $lulus[] = $value->description . '-' . $value->peserta->lulus;
                }
            }

            return view('user.pages.hasil_ujian', [
                'materi' => $materi,
                'reqSertif' => $reqSertifikat,
                'dapodik' => $data_dapodik,
                'cekBrevet' => $cekBrevet,
                'sertifikat' => $image,
                'sertifikat_nilai' => $image_nilai,
                'lulus' => $lulus,
            ]);
        }

        return view('user.pages.hasil_ujian', [
            'cekBrevet' => $cekBrevet,
            'reqSertif' => $reqSertifikat,
            'dapodik' => $data_dapodik,
            'sertifikat' => $image,
            'sertifikat_nilai' => $image_nilai,
            'materi' => [],
            'lulus' => [],
        ]);
    }

    public function transaksi(Request $request)
    {
        $manual = KeranjangProduk::with('produk','Voucher')
            ->where('username', Auth::user()->username)
            ->where('type_pembayaran', 'Manual')
            ->orderBy('id', 'DESC')
            ->get();

        $otomatis = KeranjangProduk::with('produk')
            ->where('username', Auth::user()->username)
            ->where('type_pembayaran', 'Otomatis')
            ->orderBy('id', 'DESC')
            ->get();

        $cekBrevet = KeranjangProduk::with('produk')
            ->where('username', auth()->user()->username)
            ->where('slug', 'like', 'brevet-ab%')
            ->whereIn('status', ['2', '4'])
            ->first();

        $sql = KeranjangProduk::query();
        $sql->from('keranjang_produk AS a');
        if (Auth::user()->role == '1') {
            $sql->select('a.id', 'b.name', 'b.email', 'b.pekerjaan', 'a.status', 'b.no_hp', 'c.kelas', 'c.nama_produk', 'c.harga', 'c.tgl_mulai', 'c.tgl_selesai', 'c.jam_mulai', 'c.jam_selesai', 'a.diskon', 'a.created_at', 'a.sertifikat', 'c.id AS produk_id', 'b.jumlah_anggota', 'b.ismember', 'a.slug');
            $sql->join('view_users AS b', 'a.username', '=', 'b.username');
        } else {
            $sql->select('a.id', 'b.name', 'b.email', 'b.pekerjaan', 'a.status', 'b.no_hp', 'c.kelas', 'c.nama_produk', 'c.harga', 'c.tgl_mulai', 'c.tgl_selesai', 'c.jam_mulai', 'c.jam_selesai', 'a.diskon', 'a.created_at', 'a.sertifikat', 'c.id AS produk_id', 'a.slug');
            $sql->join('users AS b', 'a.username', '=', 'b.username');
        }
        $sql->join('master_produk AS c', 'a.slug', '=', 'c.slug');
        if (isset($search_product) && !empty($search_product) && $search_product != 'All') {
            $sql->where('c.nama_produk', $search_product);
        }
        if (Auth::user()->role != '1') {
            $sql->where('a.username', Auth::user()->username)->get();
        }
        $sql->orderBy('c.nama_produk', 'asc');
        $sql->orderBy('a.id', 'desc');
        $res = $sql->get();

        return view('user.pages.transaksi', [
            'manual' => $manual,
            'otomatis' => $otomatis,
            'cekBrevet' => $cekBrevet,
            'keranjang' => $res,
        ]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
            $imagePath->move(public_path().'/profile/', $imageName); 
            $data[] = $imageName;
            User::where('id', Auth::user()->id)->update([
                'image_name' => $imageName,
            ]);
            return redirect()->route('profil');
        } else {
            return redirect()->back()->with('error', 'File upload failed.');
        }
    }

    public function printSertifikat($id)
    {
        try {
            $cek = KeranjangProduk::with('Kelas')->where('id', $id)->first();
            $sertif = Sertifikat::where('slug_product', $cek->slug)->where('username', $cek->username)->first();
            $user = User::where('email', $cek->username)->first();
            $ttd = MasterTandaTangan::where('id_ttd', $sertif->ttd_id)->first();
            // return view('user.pages.sertifikat', compact('user','cek','sertif','ttd'));

            $pdf = PDF::loadView('user.pages.sertifikat', ['user' => $user, 'cek' => $cek, 'sertif' => $sertif, 'ttd' => $ttd]);
            $pdf->getDomPDF()->set_paper('A4', 'landscape'); // Set the paper size and orientation
            $pdf->getDomPDF()->set_option('margin', 0);
            return $pdf->download('Sertifikat' . $user->name . '.pdf');
        } catch (\Throwable $th) {
            Alert::warning('Warning', 'Internal Server Error, Hubungi Admin');
            return redirect()->back();
        }

    }

    public function printNilaiBaru($id)
    {
        try {
            $cek = KeranjangProduk::with('Kelas')->where('id', $id)->first();
            $slug = $cek->slug;
            $sertif = Sertifikat::where('slug_product', $cek->slug)->where('username', $cek->username)->first();
            $user = User::where('email', $cek->username)->first();
            $ttd = MasterTandaTangan::where('id_ttd', $sertif->ttd_id)->first();
            $materi = Materi::query()
            ->with(['peserta' => function ($query) use ($slug) {
                $query->where('user_id', auth()->user()->id);
                $query->where('slug_product', $slug);
            }])
            ->get();
            // return view('user.pages.nilai', compact('user','cek','sertif','ttd'));

            $pdf = PDF::loadView('user.pages.nilai', ['user' => $user, 'cek' => $cek, 'sertif' => $sertif, 'ttd' => $ttd, 'materi' => $materi]);
            $pdf->getDomPDF()->set_paper('A4', 'landscape'); // Set the paper size and orientation
            $pdf->getDomPDF()->set_option('margin', 0);
            return $pdf->download('Nilai' . $user->name . '.pdf');
        } catch (\Throwable $th) {
            Alert::warning('Warning', 'Internal Server Error, Hubungi Admin');
            return redirect()->back();
        }

    }

    public function printNilai()
    {
        $cek = KeranjangProduk::with('produk')
            ->where('username', Auth()->user()->username)
            ->where('slug', 'like', 'brevet-ab%')
            ->where('status', '2')
            ->value('slug');

        $filename = $cek . '-' . Auth::user()->name . '-nilai.png';
        $image = Image::make(public_path('storage/sertifikat/downloaded/' . $filename));

        $pathToFile = public_path('/images/sertifikat/user-download/');
        $image->save($pathToFile . $filename);

        return response()->download($pathToFile . $filename);
    }

    public function cekTransaksi(Request $request, $id)
    {
        try {
            $transaksi = KeranjangProduk::where('id', $id)->first();
            if ($transaksi->midtrans_url) {
                if ($transaksi->payment_status == 'Pending') {
                    return $transaksi->midtrans_url;
                } else {
                    return "Data not Found";
                }
            } else {
                return "Data not Found";
            }
        } catch (\Throwable $th) {
            Alert::warning('Warning', 'Internal Server Error, Data Not Found');
            return redirect()->back();
        }
    }

    public function bayar(Request $request, $id)
    {
        try {
            $transaksi = KeranjangProduk::where('id', $request->transaksi_id)->first();
            $tenor_temp = 100 - $transaksi->tenor;
            $tenorTransaksi = intval($transaksi->tenor);

            if (intval($request->cicilan) == $tenor_temp) {
                $harga_user = $request->sisaBayarHidden;
                $status_tenor = 'FULL';
                $status = 2;
            } else {
                if ($request->cicilan == '25') {
                    $harga_user = $request->sisaBayarHidden * 25 / 100;
                    $status_tenor = 25 + $tenorTransaksi;
                    $status = 2;
                } else if ($request->cicilan == '75') {
                    $harga_user = $request->sisaBayarHidden * 75 / 100;
                    $status_tenor = 75 + $tenorTransaksi;
                    $status = 4;
                } else if ($request->cicilan == '50') {
                    $harga_user = $request->sisaBayarHidden * 50 / 100;
                    $status_tenor = 50 + $tenorTransaksi;
                    $status = 3;
                }
            }

            $transaksi->tenor = trim($status_tenor);
            $transaksi->status = $status;
            $transaksi->cicilan_temp_idr = $harga_user;
            // $transaksi->payment_status = $payment_status;
            // $transaksi->payment_status = 'Paid';
            $transaksi->update();

            $user = User::where('email', $transaksi->username)->first();

            $this->getSnapRedirect($transaksi, $request, $user);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function getSnapRedirect(KeranjangProduk $transaksi, $request, $user)
    {
        $orderId = $transaksi->id . '-' . Str::random(5);
        $transaksi->midtrans_booking_code = $orderId;
        $produk = Produk::where('id', $transaksi->id_kelas)->first();

        $item_details[] = [
            'id' => $orderId,
            'price' => $transaksi->cicilan_temp_idr,
            'quantity' => 1,
            'name' => "Pembayaran Tenor Sisa",
            'brand' => $produk->nama_produk,
            'category' => $produk->kelas,
        ];

        $item_details[] = [
            'id' => 1,
            'price' => +5000,
            'quantity' => 1,
            'name' => "Biaya Admin",
        ];
        // return $transaksi->cicilan_temp_idr;

        $transaction_details = [
            'order_id' => $orderId,
            'gross_amount' => $transaksi->cicilan_temp_idr,
        ];

        $seller_details = [
            'id' => 1,
            'name' => "IC Education",
            'email' => "info@iceducation.co.id",
            'url' => "https://iceducation.co.id/",
            "address" => [
                "first_name" => "IC",
                "last_name" => "Education",
                "phone" => "0811-1474-251",
                "address" => "Jalan Gelora II No. 10, Gelora",
                "city" => "Jakarta",
                "postal_code" => "12190",
                "country_code" => "IDN",
            ],
        ];

        $userData = [
            "first_name" => $transaksi->username,
            "last_name" => "",
            "address" => "",
            "city" => "",
            "postal_code" => "",
            "phone" => $user->no_hp,
            "country_code" => "IDN",
        ];

        $customer_details = [
            "first_name" => $user->nama_lengkap,
            "last_name" => "",
            "email" => $user->email,
            "phone" => $user->no_hp,
            "billing_address" => $userData,
            "shipping_address" => $userData,
        ];

        $midtrans_params = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
            'seller_details' => $seller_details,
        ];

        try {
            $paymentUrl = \Midtrans\Snap::createTransaction($midtrans_params)->redirect_url;
            $transaksi->midtrans_url = $paymentUrl;
            $transaksi->total_price = $transaksi->total_price + $transaksi->cicilan_temp_idr;
            $transaksi->update();
            return redirect()->to($paymentUrl)->send();
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function invoiceTransaksi(Request $request, $id)
    {
        try {
            $transaksi = KeranjangProduk::with('user')->where('id', $id)->first();
            $produk = Produk::where('slug', $transaksi->slug)->first();
            $nama_produk = str_replace('-', " ", strtoupper($produk->nama_produk));
            $isOnline = $produk->online == '1' ? 'Online' : '';
            $tanggal = date('Y-m-d');

            if (!$transaksi) {
                Alert::warning('Warning', 'Internal Server Error, Data Not Found');
                return redirect()->back();
            } else {
                $pdf = Pdf::loadview('invoice_download', ['transaksi' => $transaksi, 'nama_produk' => $nama_produk, 'tanggal' => $tanggal, 'isOnline' => $isOnline, 'produk' => $produk]);
                return $pdf->download($transaksi->no_invoice . '.pdf');
                Alert::success('Berhasil', 'Invoice Anda Berhasil Didownload');
            }
        } catch (\Throwable $th) {
            Alert::warning('Warning', 'Internal Server Error, Chat Our Administrator');
            return redirect()->back();
        }
    }
}
