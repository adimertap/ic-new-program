<?php

namespace App\Http\Controllers\User;

use Alert;
use App\Http\Controllers\Controller;
use App\Models\BankSoalUjian;
use App\Models\JawabanUser;
use App\Models\KeranjangProduk;
use App\Models\Materi;
use App\Models\PesertaUjian;
use App\Models\Produk;
use App\Models\Sertifikat;
use App\Models\Ujian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('user.pages.kelas');
    }

    function list()
    {
        $cekBrevet = KeranjangProduk::with('produk')
            ->where('username', auth()->user()->username)
            ->where('slug', 'like', 'brevet-ab%')
            // ->whereIn('tenor', ['50', '75', 'Full'])->latest()
            ->whereIn('status', ['2', '4'])->latest()
            ->first();

        $cekUjian = KeranjangProduk::with('produk')
            ->where('username', auth()->user()->username)
            ->where('slug', 'like', 'ujian%')->latest()
            ->first();

        // return $cekUjian;

        $transaksi = KeranjangProduk::with('produk')
            ->where('username', Auth()->user()->username)
            ->where('slug', 'like', 'brevet-ab%')->latest('created_at')->value('slug');

        $slug = $cekBrevet->slug;
        $reqSertif = Sertifikat::where('username', auth()->user()->username)->value('request');
        $keterangan = "";

        $akses = Produk::where('slug', $slug)->get();
        $kode_akses = '';
        foreach ($akses as $a) {
            $kode_akses = $a->akses_ujian;
        }

        $materi = Materi::query()
            ->with(['produk', 'peserta' => function ($query) {
                $query->where('user_id', auth()->user()->id);
                $query->get();
            }, 'keranjang' => function ($q) {
                $q->where('username', auth()->user()->username);
                $q->latest('created_at');
                $q->first();
            }])
            ->get();

        $cekPeserta = PesertaUjian::where('user_id', auth()->user()->id)
            ->where('slug_product', $slug)
            ->count();

        $materi_setengah = Materi::query()
            ->with(['produk', 'peserta' => function ($query) {
                $query->where('user_id', auth()->user()->id);
                $query->get();
            }, 'keranjang' => function ($q) {
                $q->where('username', auth()->user()->username);
                $q->latest('created_at');
                $q->first();
            }])
            ->whereIn('id', ['4', '5', '6', '7'])
            ->get();

        if ($kode_akses == '1') {
            $passing = $materi_setengah;
        } else if ($kode_akses == '2') {
            // return $cekBrevet;
            // if ($cekBrevet->payment_status != 'Paid' && $cekBrevet->tenor != 'Full') {
            if($cekBrevet->status == '4'){
                $passing = $materi_setengah;
                $keterangan = "Silahkan menyelesaikan angsuran untuk membuka ujian tahap kedua";
            } else {
                $passing = $materi;
            }
        } else {
            $passing = [];
        }

        // return $materi;

        return view('user.pages.list_materi', [
            'materi' => $passing,
            'keterangan' => $keterangan,
            'cekBrevet' => $cekBrevet,
            'cekUjian' => $cekUjian,
            'reqSertif' => $reqSertif,
            'kelas' => $transaksi,
            'cekPeserta' => $cekPeserta,
            'slug' => $slug,
        ]);
    }

    public function materi(Request $request)
    {
        return view('user.pages.materi');
    }

    public function rules($idMateri, $slug)
    {
        $cekBrevet = KeranjangProduk::with('produk')
            ->where('username', Auth()->user()->username)
            ->where('slug', 'like', 'brevet-ab%')
            // ->whereIn('tenor', ['50', '75', 'Full'])->latest()
            ->where('status', '2')->orWhere('status', '4')->latest()
            ->first();

        $hasil = Ujian::where('user_id', auth()->user()->id)
            ->where('materi_id', $idMateri)
            ->pluck('soal_id');

        $soal = BankSoalUjian::where('materi_id', $idMateri)
            ->whereIn('no_soal', $hasil)
            ->get();

        $materi = Materi::find($idMateri);

        return view('user.pages.rulesujian', [
            'soal' => $soal,
            'cekBrevet' => $cekBrevet,
            'slug' => $slug,
            'materi' => $materi,
        ]);
    }

    public function soal($idMateri, $slug)
    {
        $cekBrevet = KeranjangProduk::with('produk')
            ->where('username', Auth()->user()->username)
            ->where('slug', 'like', 'brevet-ab%')
            // ->whereIn('tenor', ['50', '75', 'Full'])->latest()
            ->where('status', '2')->orWhere('status', '4')->latest()
            ->first();

        $cek_lulus = PesertaUjian::where('user_id', auth()->user()->id)
            ->where('materi_id', $idMateri)
            ->where('slug_product', $slug)
            ->pluck('lulus');

        $hasil = Ujian::where('user_id', auth()->user()->id)
            ->where('materi_id', $idMateri)
            ->pluck('soal_id');
        // return $hasil;

        $soal = BankSoalUjian::leftjoin('jawaban_temp', 'jawaban_temp.soal_id', 'soal_ujian.id')
            ->where('soal_ujian.materi_id', $idMateri)
            ->whereIn('no_soal', $hasil)
            ->get();

        $perPage = 1;
        $page = request()->query('page', 1);

        if (!count($hasil)) { // ini buat materi yg belum pernah di ambil

            if ($idMateri == '11') {
                $tes = BankSoalUjian::leftjoin('jawaban_temp', 'jawaban_temp.soal_id', 'soal_ujian.id')
                    ->where('soal_ujian.materi_id', $idMateri)
                    ->Where('soal_ujian.kode_soal', 'like', 'PPN & PPnBM_HBS_09_2022')
                    ->take(25)
                    ->get();
                    // return $tes;

                $soal = new \Illuminate\Pagination\LengthAwarePaginator(
                    $tes->forPage($page, $perPage),
                    $tes->count(),
                    $perPage,
                    $page,
                    ['path' => request()->url()]
                );
            } else {
                // $soal = BankSoalUjian::where('materi_id', $idMateri)->take(5)->get();
                $tes = BankSoalUjian::leftjoin('jawaban_temp', 'jawaban_temp.soal_id', 'soal_ujian.id')
                    ->where('soal_ujian.materi_id', $idMateri)
                    ->take(25)
                    ->get();
                $soal = new \Illuminate\Pagination\LengthAwarePaginator(
                    $tes->forPage($page, $perPage),
                    $tes->count(),
                    $perPage,
                    $page,
                    ['path' => request()->url()]
                );
            }
        } elseif (!count($cek_lulus)) { //belum selesai
            $tes = BankSoalUjian::leftjoin('jawaban_temp', 'jawaban_temp.soal_id', 'soal_ujian.id')
                ->where('soal_ujian.materi_id', $idMateri)
                // ->WhereIn('soal_ujian.no_soal', $hasil)
                ->take(25)
                ->get();

            $soal = new \Illuminate\Pagination\LengthAwarePaginator(
                $tes->forPage($page, $perPage),
                $tes->count(),
                $perPage,
                $page,
                ['path' => request()->url()]
            );
        } elseif ($cek_lulus != 'Lulus') {
            if ($idMateri == '11') {
                $tes = BankSoalUjian::leftjoin('jawaban_temp', 'jawaban_temp.soal_id', 'soal_ujian.id')
                    ->where('soal_ujian.materi_id', $idMateri)
                    ->Where('soal_ujian.kode_soal', 'like', 'PPN & PPnBM_HBS_09_2022')
                    ->take(25)
                    ->get();

                $soal = new \Illuminate\Pagination\LengthAwarePaginator(
                    $tes->forPage($page, $perPage),
                    $tes->count(),
                    $perPage,
                    $page,
                    ['path' => request()->url()]
                );
            } else {
                // $soal = BankSoalUjian::where('materi_id', $idMateri)->take(5)->get();
                $tes = BankSoalUjian::leftjoin('jawaban_temp', 'jawaban_temp.soal_id', 'soal_ujian.id')
                    ->where('soal_ujian.materi_id', $idMateri)
                    ->take(25)
                    ->get();

                $soal = new \Illuminate\Pagination\LengthAwarePaginator(
                    $tes->forPage($page, $perPage),
                    $tes->count(),
                    $perPage,
                    $page,
                    ['path' => request()->url()]
                );
            }
        }

        //delete nomor sebelumnya
        Ujian::where('user_id', auth()->user()->id)
            ->where('materi_id', $idMateri)
            ->delete();

        foreach ($tes as $key) {
            Ujian::create([
                'user_id' => auth()->user()->id,
                'soal_id' => $key->no_soal,
                'materi_id' => $idMateri,
            ]);
        }

        $materi = Materi::find($idMateri);

        return view('user.pages.soal', [
            'soal' => $soal,
            'cekBrevet' => $cekBrevet,
            'slug' => $slug,
            'materi' => $materi,
        ]);
    }

    public function simpanJawaban(Request $request)
    {

        try {
            $jawaban_user = JawabanUser::join('soal_ujian', 'jawaban_temp.soal_id', 'soal_ujian.id')
                ->where('jawaban_temp.materi_id', $request->materi_id)
                ->where('jawaban_temp.user_id', Auth::user()->id)
                ->get();

            foreach ($jawaban_user as $key) {
                if ($key->jawaban == $key->jawaban_user) {
                    $status = "1";
                } else {
                    $status = "2";
                }

                Ujian::where('user_id', Auth()->user()->id)
                    ->where('soal_id', $key->no_soal)
                    ->where('materi_id', $request->materi_id)
                    ->update([
                        'jawaban' => $key->jawaban_user,
                        'benar' => $status
                    ]);
            }


            $skor = 0;
            foreach ($jawaban_user as $user) {
                if ($user->jawaban == $user->jawaban_user) {
                    // $skor += 4;
                    $skor += 20;
                } else {
                    $skor += 0;
                }
            }

            if ($skor < 60) {
                $nilai_abjad = 'D';
                $lulus = 'Tidak Lulus';
            } elseif ($skor < 70) {
                $nilai_abjad = 'C';
                $lulus = 'Lulus';
            } elseif ($skor < 80) {
                $nilai_abjad = 'B';
                $lulus = 'Lulus';
            } elseif ($skor < 90) {
                $nilai_abjad = 'A';
                $lulus = 'Lulus';
            } else {
                $nilai_abjad = 'A+';
                $lulus = 'Lulus';
            }

            if (Session::has('countdown_value')) {
                Session::forget('countdown_value');
            }


            JawabanUser::where('materi_id', $request->materi_id)->where('user_id', Auth::user()->id)->delete();

            session(['hasil' => $skor, 'abjad' => $nilai_abjad, 'lulus' => $lulus]);

            $cek = PesertaUjian::select('nilai_angka')
                ->where('user_id', auth()->user()->id)
                ->where('materi_id', $request->materi_id)
                ->where('slug_product', $request->slug)
                ->first();

            $materi_slug = Materi::query()
                ->with(['produk', 'peserta' => function ($query) {
                    $query->where('user_id', auth()->user()->id);
                }, 'keranjang' => function ($q) {
                    $q->where('username', auth()->user()->username);
                }])
                ->where('id', $request->materi_id)
                ->pluck('slug');


            $nama_materi = Materi::find($request->materi_id);

            KeranjangProduk::with('produk')
                ->where('username', Auth()->user()->username)
                ->where('slug', $request->slug)
                ->update([
                    'used' => 'used',
                ]);
                
            $cekUjian = KeranjangProduk::with('produk')
                ->where('username', auth()->user()->username)
                ->where('slug', 'like', 'ujian%')->latest()
                ->first();

            if($cekUjian){
                $cekUjian->used = 'used';
                $cekUjian->update();
            }

            if ($cek) {
                if ($cek->nilai_angka <= $skor) {
                    PesertaUjian::where('user_id', auth()->user()->id)
                        ->where('materi_id', $request->materi_id)
                        ->update([
                            'nilai_angka' => $skor,
                            'nilai_abjad' => $nilai_abjad,
                            'lulus' => $lulus,
                            'slug_product' =>  $request->slug,
                        ]);
                }
            } else {
                PesertaUjian::create([
                    'user_id' => auth()->user()->id,
                    'materi_id' => $request->materi_id,
                    'nilai_angka' => $skor,
                    'nilai_abjad' => $nilai_abjad,
                    'slug_product' =>  $request->slug,
                    'lulus' => $lulus,
                ]);
            }

            if ($request->type == 'waktu_habis') {
                return $request;
            } else {
                return redirect()->route('pembahasan', $request->materi_id);
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function pembahasan($materi_id)
    {
        $cekBrevet = KeranjangProduk::with('produk')
            ->where('username', Auth()->user()->username)
            ->where('slug', 'like', 'brevet-ab%')
            // ->whereIn('tenor', ['50', '75', 'Full'])->latest()
            ->where('status', '2')->orWhere('status', '4')->latest()
            ->first();

        $getUjian = Ujian::with(['soal' => function ($query) use ($materi_id) {
            $query->where('materi_id', $materi_id);
        }])
            ->where('user_id', auth()->user()->id)
            ->where('materi_id', $materi_id);

        $noSoal = $getUjian->get();
        $ujian = $getUjian->paginate(1);

        $materi = Materi::query()
            ->with(['produk', 'peserta' => function ($query) {
                $query->where('user_id', auth()->user()->id);
            }, 'keranjang' => function ($q) {
                $q->where('username', auth()->user()->username);
            }])
            ->where('id', $materi_id)
            ->pluck('slug');

        $nama_materi = Materi::find($materi_id);

        $peserta = PesertaUjian::where('user_id', auth()->user()->id)
            ->where('materi_id', $materi_id)
            ->get();

        $hasilUjian = PesertaUjian::where('user_id', auth()->user()->id)->get();

        $hasil = session('hasil') ?? $peserta[0]->nilai_angka;
        $abjad = session('abjad') ?? $peserta[0]->nilai_abjad;
        $lulus = session('lulus') ?? $peserta[0]->lulus;

        $data = array();
        $data['subject'] = 'Notifikasi Hasil Ujian';
        $data['nama'] = $peserta[0]->user->name;
        $data['email'] = $peserta[0]->user->email;
        $data['kelas'] = $cekBrevet->produk->kelas . ' Full Day';
        $data['Angkatan'] = number2roman($cekBrevet->produk->angkatan);
        $data['tanggal_ujian'] = $peserta[0]->created_at->format('d/m/Y');
        $data['materi_ujian'] = $nama_materi->description;
        $data['nilai_ujian'] = $hasil;
        $data['status_ujian'] = $lulus;
        $data['hasil_ujian'] = $hasilUjian;
        $data['cek_hasil'] = $hasil;

        if (count($hasilUjian) == '8') {
            $data['cek_ujian'] = "1";
            try {
                Mail::send('mail-ujian', $data, function ($message) use ($data) {
                    $message->to($data["email"], $data["nama"])
                        ->subject($data["subject"]);
                });
            } catch (JWTException $exception) {
                $serverstatuscode = "0";
                $serverstatusdes = $exception->getMessage();
            }
        } else {
            $data['cek_ujian'] = "0";
            try {
                Mail::send('mail-ujian', $data, function ($message) use ($data) {
                    $message->to($data["email"], $data["nama"])
                        ->subject($data["subject"]);
                });
            } catch (JWTException $exception) {
                $serverstatuscode = "0";
                $serverstatusdes = $exception->getMessage();
            }
        }

        return view('user.pages.pembahasan', [
            'bahas' => $ujian,
            'noSoal' => $noSoal,
            'cekBrevet' => $cekBrevet,
            'nilai' => $hasil,
            'abjad' => $abjad,
            'lulus' => $lulus,
            'nama_materi' => $nama_materi,
        ]);
    }

    public function jawaban(Request $request)
    {
        try {
            $check = JawabanUser::where('soal_id', $request->soal_id)
                ->where('materi_id', $request->materi_id)
                ->where('user_id', Auth::user()->id)
                ->first();

            if (!$check) {
                $new = new JawabanUser();
                $new->soal_id = $request->input('soal_id');
                $new->materi_id = $request->input('materi_id');
                $new->user_id = Auth::user()->id;
                $new->jawaban_user = $request->input('jawaban');
                $new->save();
            } else {
                $check->jawaban_user = $request->input('jawaban');
                $check->update();
            }

            $checkUjian = Ujian::where('soal_id', $request->soal_id)
                ->where('materi_id', $request->materi_id)
                ->where('user_id', Auth::user()->id)
                ->first();

            $jawabanBenar = BankSoalUjian::where('materi_id', $request->materi_id)
                ->where('id', $request->soal_id)
                ->first();
            if ($jawabanBenar->jawaban == $request->input('jawaban')) {
                $statusBenar = 1;
            } else {
                $statusBenar = 2;
            }

            if ($checkUjian) {
                $checkUjian->jawaban = $request->input('jawaban');
                $checkUjian->benar = $statusBenar;
                $checkUjian->update();
            }


            return $check;

            return response()->json(['message' => 'Jawaban stored']);
        } catch (\Throwable $th) {
            return response()->json(['message' => "ERROR"]);
        }
    }

    public function countdown_pre()
    {
        try {
            $countdownValue = $_POST['countdown_value'];
            Session::put('countdown_value', $countdownValue);
        } catch (\Throwable $th) {
            dd($th);
            Alert::error('Error', 'Internal Server Error');
            return redirect()->back();
        }
    }

    public function ujianUlang(Request $request)
    {
        try {
            $materi = Materi::where('id', $request->materi_id)->first();
            $user = User::with('kerjasama')
                ->where('users.id', Auth::user()->id)->first();

            $nourut = KeranjangProduk::selectRaw('MAX(SUBSTRING(no_invoice, 9, 3)) AS no_invoice')->first();
            $invoice = sprintf('%03d', ($nourut['no_invoice'] + 1));
            $bulan = number2roman(date('m'));
            $tahun = date('Y');
            $no_invoice = 'NO. INV-' . $invoice . '/ICEDU/' . $bulan . '/' . $tahun;

            $keranjang = new KeranjangProduk();
            $keranjang->id_instansi = $user->kerjasama_id;
            $keranjang->slug = $materi->slug;
            $keranjang->username = $user->username;
            $keranjang->aktif = 1;
            $keranjang->status = 1;
            $keranjang->no_invoice = $no_invoice;
            $keranjang->payment_status = 'Pending';
            $keranjang->total_price = 50000;
            $keranjang->type_pembayaran = 'Manual';
            $keranjang->harga_kelas = 50000;
            $keranjang->tenor = 'Full';
            $keranjang->save();

            return redirect()->route('transaksi');
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
