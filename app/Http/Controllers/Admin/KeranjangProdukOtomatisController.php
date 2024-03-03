<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KeranjangProduk;
use App\Models\Kerjasama;
use App\Models\Produk;
use Illuminate\Http\Request;
use Alert;
use App\Models\User;
use Str;
use Exception;
use Illuminate\Support\Facades\Auth;
use Midtrans;
use PDF;
use Illuminate\Support\Facades\Mail;


class KeranjangProdukOtomatisController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        Config::$is3ds = env('MIDTRANS_IS_3DS');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instansi = Kerjasama::leftjoin('keranjang_produk','master_kerjasama.id','keranjang_produk.id_instansi')
        ->join('master_jenis_kerjasama','master_kerjasama.id_jenis','master_jenis_kerjasama.id_jenis')
        ->selectRaw('master_kerjasama.id, keranjang_produk.type_pembayaran, nama, jenis, COUNT(no_invoice) as jumlah_keranjang')
        ->where('type_pembayaran', 'Otomatis')
        ->groupBy('nama','jenis','id','type_pembayaran')
        ->get();

        return view('admin.pages.keranjangMidtrans.keranjang-instansi-midtrans',compact('instansi'));
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
        $products = KeranjangProduk::
        with(['produk', 'Instansi'])
        ->where('type_pembayaran', 'Otomatis')
        ->where('id_instansi', $id);
        if($request->filterKelas){
          $products->where('slug', $request->filterKelas);
        }
        if($request->filterStatus){
              $products->where('payment_status', $request->filterStatus);
        }
        $products = $products->orderBy('keranjang_produk.created_at', 'desc')->get();
        $count = $products->count();

        $instansi = Kerjasama::where('id', $id)->first();
        $activeProducts = Produk::where('aktif', '1')->get();

        return view('admin.pages.keranjangMidtrans.keranjang-produk-midtrans', [
          'products' => $products,
          'active' => $activeProducts,
          'instansi' => $instansi
        ]);
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
        $transaksi = KeranjangProduk::find($id);
        return $transaksi;
        $orderId = $transaksi->id. '-' .Str::random(5);
        $transaksi->midtrans_booking_code = $orderId;
        $transaksi->update();

        if($request->cicilan == '-75'){
            $ket_tenor = '75%';
        }else if($request->cicilan == '-50'){
            $ket_tenor = '50%';
        }else if($request->cicilan == '-25'){
            $ket_tenor = '25%';
        }

        $item_details[] = [
            'id' => $orderId,
            'price' => $request->harga_tenor,
            'quantity' => 1,
            'name' => "Pembayaran Kelas Tenor" . $ket_tenor,
            'brand' => $request->nama_produk,
            'category' => $request->kelas
        ];

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

    public function changeManual(Request $request, $id)
    {
        try {
            $transaksi = KeranjangProduk::where('id', $id)->first();
            $transaksi->type_pembayaran = 'Manual';
            $transaksi->save();

            Alert::success('Success', 'Transaksi tersebut diganti menjadi pembayaran manual');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::warning('Warning', 'Internal Server Error, Data Not Found');
            return redirect()->back();
        }
    }

    public function generateLink_Pending(Request $request, $id){
        try {
            $tr = KeranjangProduk::where('id', $id)->first();
            return $tr;

        } catch (\Throwable $th) {
            Alert::warning('Warning', 'Internal Server Error, Data Not Found');
            return redirect()->back();
        }
    }


    public function generateLink(Request $request, $id)
    {
        try {
            $transaksi = KeranjangProduk::where('id', $id)->first();
            $tenor_temp = 100 - $transaksi->tenor;

            if(intval($request->cicilan) == $tenor_temp){
                $harga_user = $request->sisa_pembayaran;
            }else{
                if($request->cicilan == '25'){
                    $harga_user = $request->sisa_pembayaran * 25 / 100;
                }else if($request->cicilan == '75'){
                    $harga_user = $request->sisa_pembayaran * 75 / 100;
                }else if($request->cicilan == '50'){
                    $harga_user = $request->sisa_pembayaran * 50 / 100;
                }
            }

            $transaksi->cicilan_temp_idr = $harga_user;
            // $transaksi->payment_status = 'Paid';
            $transaksi->update();
            $user = User::where('email', $transaksi->username)->first();
            $paymentUrl = $this->getSnapRedirectKeranjang($transaksi, $request, $user);

            if($request->radio == 'Email'){
                $produk = Produk::where('slug', $transaksi->slug)->first();
                $nama_produk = str_replace('-', " ", strtoupper($produk->nama_produk));
                $isOnline = $produk->online == '1' ? 'Online' : '';
                $tanggal = date('Y-m-d');
    
                $data = array();
                $data['email'] = $user->email;
                $data['subject'] = 'Info Pembelian Kelas dan Pembayaran';
                $data['nama'] = Auth::user()->name;
                $data['deskripsi'] = 'Pembelian produk ' . $nama_produk . ' Hari ' . $produk->kelas . ' ( ' . $isOnline . ' ) ';
                $data['nominal'] = $produk->harga;
                $data['kelas'] = $produk->kelas;
                $data['slug'] = $produk->slug;
                $data['tanggal'] = date('Y-m-d');
                $data['username'] = $user->email;
                $data['no_invoice'] = $transaksi->no_invoice;
                $data['produk'] = $produk->nama_produk;
                $data['diskon'] = $transaksi->diskon;
                $data['link'] =  $paymentUrl;
                $data['besaran'] = $harga_user;
                $data['mail_cc_1'] = env('MAIL_CC_1');
                $pdf = PDF::loadview('invoice_download', ['transaksi' => $transaksi, 'nama_produk' => $nama_produk, 'tanggal' => $tanggal, 'isOnline' => $isOnline, 'produk' => $produk]);
                $pdf->setPaper('A4', 'portrait');
    
                try {
                    Mail::send('mail-midtrans-kurang', $data, function ($message) use ($data, $pdf) {
                        $message->to($data["username"])
                            ->subject("Info Pembelian Kelas dan Pembayaran")
                            ->cc($data["mail_cc_1"])
                            ->attachData($pdf->output(), "invoice.pdf");
                    });
                } catch (JWTException $exception) {
                    $serverstatuscode = "0";
                    $serverstatusdes = $exception->getMessage();
                }
            }

            return $paymentUrl;

        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function getSnapRedirectKeranjang(KeranjangProduk $transaksi, $request, $user)
    {

        $orderId = $transaksi->id. '-' .Str::random(5);
        $transaksi->midtrans_booking_code = $orderId;
        $produk = Produk::where('id', $transaksi->id_kelas)->first();

        $item_details[] = [
            'id' => $orderId,
            'price' => $transaksi->cicilan_temp_idr,
            'quantity' => 1,
            'name' => "Pembayaran Tenor Sisa",
            'brand' => $produk->nama_produk,
            'category' => $produk->kelas
        ];

        $item_details[] = [
            'id' => 1,
            'price' =>  + 5000,
            'quantity' => 1,
            'name' => "Biaya Admin",
        ];
        // return $transaksi->cicilan_temp_idr;

        $transaction_details = [
            'order_id' => $orderId,
            'gross_amount' => $transaksi->cicilan_temp_idr
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
            "first_name" => $transaksi->username,
            "last_name" => "",
            "address" => "",
            "city" => "",
            "postal_code" => "",
            "phone" => $user->no_hp,
            "country_code" => "IDN"
        ];

        $customer_details = [
            "first_name" => $user->nama_lengkap,
            "last_name" => "",
            "email" => $user->email,
            "phone" => $user->no_hp,
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
            $tenor_temp = 100 - $transaksi->tenor;
            if(intval($request->cicilan) == $tenor_temp){
                $status_tenor = 'FULL';
            }else{
                if($request->cicilan == '25'){
                    $status_tenor = 25 + $transaksi->tenor;
                }else if($request->cicilan == '75'){
                    $status_tenor = 75 + $transaksi->tenor;
                }else if($request->cicilan == '50'){
                    $status_tenor = 50 + $transaksi->tenor;
                }
            }
          
            $transaksi->sisaTenor = strval($status_tenor);
            $transaksi->midtrans_url = $paymentUrl;
            $transaksi->total_price = $transaksi->cicilan_temp_idr;
            $transaksi->update();
            return $paymentUrl;
        }catch (Exception $e){
            dd($e);
        }
    }
}
