<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produk;
use App\Models\Kerjasama;
use PDF;
use Illuminate\Http\Request;
use App\Models\KeranjangProduk;
use App\Models\MasterJenisInstansi;
use App\Models\MetaDescription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
class AuthController extends Controller
{
    public function login($params = null)
    {
        $admin = Auth::user();
        
        if ($admin) {
            if ($admin->role == '1') {
                return redirect()->route('admin-dashboard');
            }

            if (isset($params) && !empty($params)) {
                $nourut = KeranjangProduk::selectRaw('MAX(SUBSTRING(no_invoice, 9, 3)) AS no_invoice')->first();
                $invoice = sprintf('%03d', ($nourut['no_invoice'] + 1));
                $bulan = number2roman(date('m'));
                $tahun = date('Y');
                $no_invoice = 'NO. INV-' . $invoice . '/ICEDU/' . $bulan . '/' . $tahun;

                KeranjangProduk::create([
                    'username' => $admin->email,
                    'slug' => $params,
                    'aktif' => 1,
                    'no_invoice' => $no_invoice,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                return redirect()->route('keranjang-invoice');
            }

            return redirect()->route('home-beranda');
        }
        $meta = MetaDescription::where('pages','Login')->first();
        return view('auth.login', compact('meta'));
    }

    public function authLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // return $request;

        $user = User::where('username', $request->username)->first();
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            if ($user->role == 5) {
                return redirect()->route('pemateri-dashboard');
            }

            if ($user->role != 1) {
                if (isset($request->slug) && !empty($request->slug)) {
                    $nourut = KeranjangProduk::selectRaw('MAX(SUBSTRING(no_invoice, 9, 3)) AS no_invoice')->first();
                    $invoice = sprintf('%03d', ($nourut['no_invoice'] + 1));
                    $bulan = number2roman(date('m'));
                    $tahun = date('Y');
                    $no_invoice = 'NO. INV-' . $invoice . '/ICEDU/' . $bulan . '/' . $tahun;

                    KeranjangProduk::create([
                        'username' => $user->email,
                        'slug' => $request->slug,
                        'aktif' => 1,
                        'no_invoice' => $no_invoice,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);

                    return redirect()->route('keranjang-invoice');
                }



                Alert::success('Berhasil Login', 'Selamat Datang '.$user->name.', Pilih dan Daftar Kelas Sekarang Juga!');
                return redirect()->route('home-beranda');
            }

            return redirect()->route('admin-dashboard');
        }

        Alert::warning('Warning', 'Username atau Password Anda Salah');
        return redirect()->back();  
        // return back()->withErrors([
        //     'credentials' => 'Username atau Password anda salah'
        // ])->withInput();
    }

    public function authLogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home-beranda');
    }

    public function register()
    {
        $products = Produk::where('aktif', 1)
            ->whereIn('nama_produk', ['brevet-ab', 'seminar'])
            ->get();

        $instansi = Kerjasama::all();
        $meta = MetaDescription::where('pages','Register')->first();

        return view('auth.register', [
            'produk' => $products,
            'instansi' => $instansi,
            'meta' => $meta
        ]);
    }

    public function checkEmail(Request $request)
    {
        $data = User::where(['email' => $request->input('email')])->count();
        return response()->json(['message' => $data]);
    }

    public function authRegister(Request $request)
    {
        $slugProduct = $request->slug;

        $pwd = $request->input('password');
        $nourut = KeranjangProduk::selectRaw('MAX(SUBSTRING(no_invoice, 9, 3)) AS no_invoice')
            ->first();

        $invoice = sprintf('%03d', ($nourut['no_invoice'] + 1));
        $bulan = number2roman(date('m'));
        $tahun = date('Y');
        $no_invoice = 'NO. INV-' . $invoice . '/ICEDU/' . $bulan . '/' . $tahun;

        User::create([
            'name' => $request->input('nama'),
            // 'no_hp' => $request->input('no_hp'),
            'email' => $request->input('email'),
            // 'pekerjaan' => $request->input('pekerjaan'),
            // 'kerjasama_id' => $request->input('kerjasama'),
            'username' => $request->input('email'),
            'active' => '1',
            'role' => '2',
            'password' => Hash::make($pwd),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if (isset($slugProduct) && !empty($slugProduct)) {
            KeranjangProduk::create([
                'username' => $request->input('email'),
                'slug' => $slugProduct,
                'aktif' => 1,
                'no_invoice' => $no_invoice,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        if (auth()->attempt(array('username' => $request->input('email'), 'password' => $pwd))) {
            if (isset($slugProduct) && !empty($slugProduct)) {
                return redirect()->route('keranjang-invoice');
            } else {
                $data = array();
                $data['email'] = $request->input('email');
                $data['subject'] = 'Informasi IC Education';
                $data['nama'] = $request->input('nama');
                $data['username'] = $request->input('email');
                $data['password'] = $pwd;
                $data['produk'] = $request->input('nama_produk');
                $data['isregonly'] = "1";

                try {
                    Mail::send('mail', $data, function ($message) use ($data) {
                        $message->to($data["email"], $data["nama"])
                            ->subject($data["subject"]);
                            // ->cc(['info@iceducation.co.id', 'ritarohati18@gmail.com', 'junaidi.yasin@indonesiaconsult.com']);
                    });
                } catch (JWTException $exception) {
                    $serverstatuscode = "0";
                    $serverstatusdes = $exception->getMessage();
                }

                return redirect()->route('user-dashboard')->with('success', 'Anda tidak membeli produk apapun, Ayo buruan beli. Silahkan cek email yang terdaftar untuk mendapatkan informasi login');
            }
        } else {
            return redirect()->route('login')->with('status', 'Username atau Password salah');
        }
    }

    public function authRegisterDataUser(Request $request, $slug){

        $item = Produk::where('slug', $slug)->first();
        $instansi = Kerjasama::get();
        $jenis = MasterJenisInstansi::get();
        $meta = MetaDescription::where('pages', 'LengkapiData')->first();

        return view('auth.registerKelengkapan', compact('item','instansi','jenis','meta'));
    }


    public function UpdateDataUser(Request $request){
        try {
            if($request->id_instansi == 'Lainnya'){
                Alert::warning('Warning', 'Anda Belum Memilih Asal Instansi');
                return redirect()->back();
            }else{
                $item = User::where('id', Auth::user()->id)->first();
                if($item){
                    $item->no_hp = $request->phone;
                    $item->pekerjaan = $request->pekerjaan;
                    $item->kerjasama_id = $request->id_instansi;
                    $item->update();
    
                    return redirect()->route('checkout.edit', $request->id_kelas);
                }else{
                    Alert::warning('Warning', 'Internal Server Error, Data Not Found');
                    return redirect()->back();
                }
            }
        } catch (\Throwable $th) {
            Alert::warning('Warning', 'Internal Server Error, Data Not Found');
            return redirect()->back();
        }
    }

    public function simpanInstansi(Request $request){
        try {
          
                $check = Kerjasama::where('nama', $request->nama)->first();
                if($check){
                    Alert::warning('Error','Data Instansi Sudah Ada');
                    return redirect()->back();
                }else{
                    $item = new Kerjasama();
                    $item->id_jenis = $request->id_jenis;
                    $item->nama = strtoupper($request->nama);
                    $item->save();
    
                    Alert::success('Success Title', 'Data Instansi Berhasil Ditambahkan, Lanjut Pendaftaran');
                    return redirect()->back();
                }

            

        } catch (\Throwable $th) {
            Alert::warning('Warning', 'Internal Server Error, Data Not Found');
            return redirect()->back();
        }
    }

    public function forgotPassword()
    {
        return view('auth.forgot');
    }

    public function authForgotPassword(Request $request)
    {
        $check = User::where('email', $request->email)->first();
        if($check){
            $data['email'] = $request->email;
            try {
                Mail::send('mail-reset', $data, function ($message) use ($data) {
                    $message->to($data["email"])
                        ->subject("Reset Password - IC Education");
                });
            } catch (JWTException $exception) {
                $serverstatuscode = "0";
                $serverstatusdes = $exception->getMessage();
            }

            Alert::success('Success', 'Email Reset Password Berhasil dikirim check inbox Anda');
            return redirect()->back();
        }else{
            Alert::warning('Error', 'Email tidak ditemukan, Daftar terlebih dahulu');
            return redirect()->back();
        }
    }
    public function changePasswordUI(Request $request){
        $email = $request->email;
        return view('auth.change-password', compact('email'));
    }
    
    
    public function changePassword(Request $request){
        try {
            if ($request->new_password != $request->new_password_confirmation){
                Alert::warning('Error', 'Password Confirmation Anda salah dan tidak sama dengan Password');
                return redirect()->back();
            }else{
                User::where('email', $request->email)->update([
                    'password' => Hash::make($request->new_password)
                ]);
                Alert::success('Success', 'Password Anda Telah Dirubah');
                return redirect()->route('login');
            }
        } catch (\Throwable $th) {
            Alert::warning('Error', 'Internal Server Error');
            return redirect()->back();
        }
        
    }
}
