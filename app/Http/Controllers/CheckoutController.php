<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\Models\KeranjangProduk;
use App\Models\Kerjasama;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Str;
use Exception;
use Midtrans;
use Barryvdh\DomPDF\Facade\Pdf;
use Midtrans\Config;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = "SB-Mid-server-ThmSXotcqD9A6m7KSd-SIaEG";
        Config::$isProduction = false;
        Config::$isSanitized = false;
        Config::$is3ds = false;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = User::with('kerjasama')
        ->where('users.id', Auth::user()->id)->first();
        $instansi = Kerjasama::get();

        return view('home.pages.checkout50rb');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $user = User::with('kerjasama')
            ->where('users.id', Auth::user()->id)->first();
            $instansi = Kerjasama::get();

            $item = Produk::where('slug', $id)->first();

            $harga_pokok = $item->harga;
           
            if($user->kerjasama){
                if($user->kerjasama->status == 'Angka'){
                    $harga_final = $harga_pokok - $user->kerjasama->diskon_angka;
                }else{
                    $harga_final = $harga_pokok - ($harga_pokok/100) * $user->kerjasama->diskon_online;
                }
            }else{
                $harga_final = $harga_pokok;
            }

            return view('home.pages.checkout', compact('item','user','instansi','harga_final'));

        } catch (\Throwable $th) {
            return $th;
            Alert::warning('Warning', 'Internal Server Error, Data Not Found');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    public function update(Request $request, $slug)
    {   
        // return $request;
        try {
            $find_produk = Produk::where('slug', $slug)->first();
            $user = User::where('id', Auth::user()->id)->first();
            $user->pekerjaan = $request->pekerjaan;
            $user->email = $request->email;
            $user->no_hp = $request->no_hp;
            $user->kerjasama_id = $request->instansi;
            $user->update();

            $nourut = KeranjangProduk::selectRaw('MAX(SUBSTRING(no_invoice, 9, 3)) AS no_invoice')->first();
            $invoice = sprintf('%03d', ($nourut['no_invoice'] + 1));
            $bulan = number2roman(date('m'));
            $tahun = date('Y');
            $no_invoice = 'NO. INV-' . $invoice . '/ICEDU/' . $bulan . '/' . $tahun;

            $transaksi = new KeranjangProduk;
            $transaksi->username = $user->email;
            $transaksi->payment_status = 'Pending';
            $transaksi->id_kelas = $find_produk->id;
            $transaksi->aktif = 1;
            $transaksi->no_invoice = $no_invoice;
            $transaksi->slug = $find_produk->slug;
            $transaksi->total_price = $request->harga_hidden_final;
            $transaksi->type_pembayaran = $request->jenis;
            $transaksi->tenor = $request->tenor;
            $transaksi->sisaTenor = $request->tenor;
            $transaksi->diskon = $request->diskon_hidden;
            $transaksi->type_diskon = $request->type_diskon;
            $transaksi->harga_kelas = $request->harga_asli;
            $transaksi->id_instansi = $request->instansi;
            $transaksi->status = 1;
            $transaksi->data = 'New';
            $transaksi->save();

            if($request->jenis == 'Otomatis'){
                $this->getSnapRedirect($transaksi, $request);
            }else{
                $produk = Produk::where('slug', $transaksi->slug)->first();
                $nama_produk = str_replace('-', " ", strtoupper($produk->nama_produk));
                $isOnline = $produk->online == '1' ? 'Online' : '';
                $tanggal = date('Y-m-d');
                $data = array();
                $data['email'] = Auth::user()->email;
                $data['subject'] = 'Invoice IC Education';
                $data['nama'] = Auth::user()->name;
                $data['deskripsi'] = 'Pembelian produk ' . $nama_produk . ' Hari ' . $produk->kelas . ' ( ' . $isOnline . ' ) ';
                $data['nominal'] = $produk->harga;
                $data['kelas'] = $produk->kelas;
                $data['slug'] = $produk->slug;
                $data['tanggal'] = date('Y-m-d');
                $data['username'] = Auth::user()->email;
                $data['password'] = Auth::user()->password_get_info;
                $data['diskon'] = 0;
                $data['sum_diskon'] = 0;
                $data['total'] = $produk->harga;
                $data['no_invoice'] = $transaksi->no_invoice;
                $data['produk'] = $produk->nama_produk;
                $data['diskon'] = $transaksi->diskon;
                $data['isregonly'] = "0";
                $pdf = PDF::loadview('invoice_download', ['transaksi' => $transaksi, 'nama_produk' => $nama_produk, 'tanggal' => $tanggal, 'isOnline' => $isOnline, 'produk' => $produk]);
                $pdf->setPaper('A4', 'portrait');

                try {
                    Mail::send('mail', $data, function ($message) use ($data, $pdf) {
                        $message->to($data["username"])
                            ->subject("Invoice IC Education")
                            ->cc(['adimertap@gmail.com','adimerta@student.unud.ac.id'])
                            // ->cc(['info@iceducation.co.id', 'ritarohati18@gmail.com', 'junaidi.yasin@indonesiaconsult.com'])
                            ->attachData($pdf->output(), "invoice.pdf");
                    });
                } catch (JWTException $exception) {
                    $serverstatuscode = "0";
                    $serverstatusdes = $exception->getMessage();
                }
                Alert::success('Success', 'Pesanan Anda Telah Masuk, Mohon Menunggu Konfirmasi dari Admin Kami! Check Dashboard');
                return redirect()->route('home-beranda');
            }

        } catch (\Throwable $th) {
            return $th;
            Alert::warning('Warning', 'Internal Server Error, Data Not Found');
            return redirect()->back();
        }
    }

    public function getSnapRedirect(KeranjangProduk $transaksi, $request)
    {
        $orderId = $transaksi->id. '-' .Str::random(5);
        $transaksi->midtrans_booking_code = $orderId;
        $price = $request->harga_tenor;
        if($request->tenor == 'Full'){
            $ket_tenor = ' Full';
        }else if($request->tenor == '25'){
            $ket_tenor = ' 25 %';
        }else if($request->tenor == '50'){
            $ket_tenor = ' 50 %';
        }else if($request->tenor == '75'){
            $ket_tenor = ' 75 %';
        }

        $item_details[] = [
            'id' => $orderId,
            'price' => $request->harga_tenor,
            'quantity' => 1,
            'name' => "Pembayaran Kelas, Tenor" . $ket_tenor,
            'brand' => $request->nama_produk,
            'category' => $request->kelas
        ];

        if($transaksi->diskon != 0 || $transaksi->diskon != null){
            $discountPrice = 0;
            if($request->type_diskon == 'Angka'){
                $discountPrice = $transaksi->diskon;
            }else{
                $discountPrice = $price * $transaksi->diskon / 100;
            }
            $item_details[] = [
                'id' => $request->instansi,
                'price' => -$discountPrice,
                'quantity' => 1,
                'name' => "Diskon Instansi",
            ];
        }

        $item_details[] = [
            'id' => 1,
            'price' =>  + 5000,
            'quantity' => 1,
            'name' => "Biaya Admin",
        ];

        $transaction_details = [
            'order_id' => $orderId,
            'gross_amount' => $request->harga_tenor
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
                "country_code" => "IDN"
            ]
        ];

        $userData = [
            "first_name" => $request->nama_lengkap,
            "last_name" => "",
            "address" => "",
            "city" => "",
            "postal_code" => "",
            "phone" => $request->no_hp,
            "country_code" => "IDN"
        ];

        $customer_details = [
            "first_name" => $request->nama_lengkap,
            "last_name" => "",
            "email" => $request->email,
            "phone" => $request->no_hp,
            "billing_address" => $userData,
            "shipping_address" => $userData
        ];

        $midtrans_params = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
            'seller_details' => $seller_details
        ];

        try{
            $paymentUrl = \Midtrans\Snap::createTransaction($midtrans_params)->redirect_url;
            $transaksi->midtrans_url = $paymentUrl;
            $transaksi->total_price = $request->harga_hidden_final;
            $transaksi->save();

            $produk = Produk::where('slug', $transaksi->slug)->first();
            $nama_produk = str_replace('-', " ", strtoupper($produk->nama_produk));
            $isOnline = $produk->online == '1' ? 'Online' : '';
            $tanggal = date('Y-m-d');

            $data = array();
            $data['email'] = Auth::user()->email;
            $data['subject'] = 'Invoice IC Education';
            $data['nama'] = Auth::user()->name;
            $data['deskripsi'] = 'Pembelian produk ' . $nama_produk . ' Hari ' . $produk->kelas . ' ( ' . $isOnline . ' ) ';
            $data['nominal'] = $produk->harga;
            $data['kelas'] = $produk->kelas;
            $data['slug'] = $produk->slug;
            $data['tanggal'] = date('Y-m-d');
            $data['username'] = Auth::user()->email;
            $data['password'] = Auth::user()->password_get_info;
            $data['diskon'] = 0;
            $data['sum_diskon'] = 0;
            $data['total'] = $produk->harga;
            $data['no_invoice'] = $transaksi->no_invoice;
            $data['produk'] = $produk->nama_produk;
            $data['diskon'] = $transaksi->diskon;
            $data['isregonly'] = "0";
            $data['link'] =  $paymentUrl;
            $pdf = PDF::loadview('invoice_download', ['transaksi' => $transaksi, 'nama_produk' => $nama_produk, 'tanggal' => $tanggal, 'isOnline' => $isOnline, 'produk' => $produk]);
            $pdf->setPaper('A4', 'portrait');

            try {
                Mail::send('mail-midtrans', $data, function ($message) use ($data, $pdf) {
                    $message->to($data["username"])
                        ->subject("Invoice IC Education")
                        ->cc(['adimertap@gmail.com','adimerta@student.unud.ac.id'])
                        // ->cc(['info@iceducation.co.id', 'ritarohati18@gmail.com', 'junaidi.yasin@indonesiaconsult.com'])
                        ->attachData($pdf->output(), "invoice.pdf");
                });
            } catch (JWTException $exception) {
                $serverstatuscode = "0";
                $serverstatusdes = $exception->getMessage();
            }


            return redirect()->to($paymentUrl)->send();
            // header('Location: '.$paymentUrl);
            // return $paymentUrl;

        }catch (Exception $e){
            dd($e);
        }
    }

    public function midtransCallback (Request $request)
    {
        try {
            $notif = $request->method() == 'POST' ? new Midtrans\Notification() : Midtrans\Transaction::status($request->order_id);

            $transaction_status = $notif->transaction_status;
            $fraud = $notif->fraud_status;
    
            $checkout_id = explode('-', $notif->order_id)[0];
            $checkout = KeranjangProduk::where('id', $checkout_id)->first();
            
            if ($transaction_status == 'capture') {
                if ($fraud == 'challenge') {
                    $checkout->payment_status = 'Pending';
                    $checkout->save();
                    return redirect()->route('midtransPending');
                    // return view('home.pages.statusMidtrans.pending_checkout');
                }
                else if ($fraud == 'accept') {
                    if($checkout->tenor == '25'){
                        $status = '5';
                        $pstatus = 'Cicilan';
                    }else if($checkout->tenor == '50'){
                        $status = '3';
                        $pstatus = 'Cicilan';
                    }else if($checkout->tenor == '75'){
                        $status = '4';
                        $pstatus = 'Cicilan';
                    }else if($checkout->tenor == 'Full'){
                        $status = '2';
                        $pstatus = 'Paid';
                    }
                    $checkout->tenor = $checkout->sisaTenor;
                    $checkout->status = $status;
                    $checkout->payment_status = $pstatus;
                    $checkout->update();
                    return redirect()->route('midtransSuccess');
                    // return view('home.pages.statusMidtrans.success_checkout');
                }
            }
            else if ($transaction_status == 'cancel') {
                if ($fraud == 'challenge') {
                    $checkout->payment_status = 'Failed';
                    $checkout->save();
                    return redirect()->route('midtransError');
                    // return view('home.pages.statusMidtrans.error_checkout');
                }
                else if ($fraud == 'accept') {
                    $checkout->payment_status = 'Failed';
                    $checkout->save();
                }
            }
            else if ($transaction_status == 'deny') {
                $checkout->payment_status = 'Failed';
                $checkout->save();
                return redirect()->route('midtransError');
                // return view('home.pages.statusMidtrans.error_checkout');
            }
            else if ($transaction_status == 'settlement') {
                if($checkout->tenor == '25'){
                    $status = '5';
                    $pstatus = 'Cicilan';
                }else if($checkout->tenor == '50'){
                    $status = '3';
                    $pstatus = 'Cicilan';
                }else if($checkout->tenor == '75'){
                    $status = '4';
                    $pstatus = 'Cicilan';
                }else if($checkout->tenor == 'Full'){
                    $status = '2';
                    $pstatus = 'Paid';
                }
                $checkout->tenor = $checkout->sisaTenor;
                $checkout->status = $status;
                $checkout->payment_status = $pstatus;
                $checkout->update();
                return redirect()->route('midtransSuccess');
                // return view('home.pages.statusMidtrans.success_checkout');
            }
            else if ($transaction_status == 'pending') {
                $checkout->payment_status = 'Pending';
                $checkout->save();
                return redirect()->route('midtransPending');
                // return view('home.pages.statusMidtrans.pending_checkout');
            }
            else if ($transaction_status == 'expire') {
                $checkout->payment_status = 'Failed';
                $checkout->save();
                return redirect()->route('midtransError');
                // return view('home.pages.statusMidtrans.error_checkout');
            }
        } catch (\Throwable $th) {
            return $th;
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
        //
    }

    public function profile_update(Request $request){
        try {
            $user_find = User::where('id', Auth::user()->id)->first();
            $user_find->kerjasama_id = $request->kerjasama_id;
            $user_find->update();

            return $request;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function midtransUnfinished()
    {
        return view('home.pages.statusMidtrans.error_checkout');
    }

    public function midtransError()
    {
        return view('home.pages.statusMidtrans.error_checkout');
    }

    public function midtransSuccess()
    {
        return view('home.pages.statusMidtrans.success_checkout');
    }
    
    public function midtransPending()
    {
        return view('home.pages.statusMidtrans.pending_checkout');
    }
}
