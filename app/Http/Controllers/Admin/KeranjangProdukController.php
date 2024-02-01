<?php

namespace App\Http\Controllers\Admin;


use App\Models\Diskon;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\KeranjangProduk;
use App\Mail\CancelTransactionMail;
use App\Http\Controllers\Controller;
use App\Models\Kerjasama;
use App\Models\Materi;
use App\Models\TrashKeranjangProduk;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;

class KeranjangProdukController extends Controller
{
  public function index()
  {
    $instansi = Kerjasama::join('keranjang_produk','master_kerjasama.id','keranjang_produk.id_instansi')
    ->join('master_jenis_kerjasama','master_kerjasama.id_jenis','master_jenis_kerjasama.id_jenis')
    ->selectRaw('master_kerjasama.id, keranjang_produk.type_pembayaran, nama, jenis, COUNT(no_invoice) as jumlah_keranjang')
    ->where('type_pembayaran', 'Manual')
    ->groupBy('nama','jenis','id','type_pembayaran')
    ->get();


    return view('admin.pages.keranjang-instansi',compact('instansi'));

  }

  public function detail(Request $request, $id)
  {
        $products = KeranjangProduk::
        with(['produk', 'Instansi','Voucher'])
        ->where('type_pembayaran', 'Manual')
        ->where('aktif', 1)
        ->where('id_instansi', $id);
        if($request->filterKelas){
          $products->where('slug', $request->filterKelas);
        }
        if($request->filterStatus){
          if($request->filterStatus == 'Pending'){
              $products->where('status', 1);
          }else{
              $products->where('tenor', $request->filterStatus)->where('status', '!=', 1);
          }
        }
        $products = $products->orderBy('keranjang_produk.created_at', 'desc')->get();
        $count = $products->count();

        $instansi = Kerjasama::where('id', $id)->first();
        $activeProducts = Produk::where('aktif', '1')->get();


        return view('admin.pages.keranjang-produk', [
          'products' => $products,
          'active' => $activeProducts,
          'instansi' => $instansi,
          'count' => $count
        ]);
  }

  public function changeTransaction(Request $request)
  {
      $transaksi = KeranjangProduk::with(['user', 'produk'])->where('id', $request->id);
      $getTransaksi = $transaksi->get();

      $nourut = KeranjangProduk::selectRaw('MAX(SUBSTRING(no_invoice, 9, 3)) AS no_invoice')->first();
      $invoice = sprintf('%03d', ($nourut['no_invoice'] + 1));
      $bulan = number2roman(date('m'));
      $tahun = date('Y');
      $no_invoice = 'NO. INV-' . $invoice . '/ICEDU/' . $bulan . '/' . $tahun;

      $transaksi->update([
        'slug' => $request->slug,
        'no_invoice' => $no_invoice
      ]);

      $produk = Produk::where('slug', $request->slug)->first();
      $nama_produk = str_replace('-', " ", strtoupper($produk->nama_produk));
      $isOnline = $produk->online == 1 ? 'Online' : '';

      $data = array();
      $data['email'] = $getTransaksi[0]->user->email;
      $data['subject'] = 'Info Pembelian Kelas dan Pembayaran';
      $data['nama'] = $getTransaksi[0]->user->name;
      $data['deskripsi'] = 'Pembelian produk ' . $nama_produk . ' Hari ' . $produk->kelas . ' ( ' . $isOnline . ' ) ';
      $data['nominal'] = $produk->harga;
      $data['kelas'] = $produk->kelas;
      $data['slug'] = $request->slug;
      $data['tanggal'] = date('Y-m-d');
      $data['name'] = $getTransaksi[0]->user->email;
      $data['password'] = $getTransaksi[0]->user->password;
      $data['diskon'] = 0;
      $data['sum_diskon'] = 0;
      $data['change_transaction'] = 1;
      $data['total'] = $produk->harga;
      $data['no_invoice'] = $no_invoice;
      $data['produk'] = $nama_produk;
      $data['isregonly'] = "0";
      $data['mail_cc_1'] = env('MAIL_CC_1');

      $pdf = PDF::loadView('invoice', $data);
      $pdf->setPaper('A4', 'portrait');

      try {
        Mail::send('mail', $data, function ($message) use ($data, $pdf) {
          $message->to($data["email"], $data["nama"])
            ->subject($data["subject"])
            ->cc($data["mail_cc_1"])
            ->attachData($pdf->output(), "invoice.pdf");
        });
      } catch (JWTException $exception) {
        $serverstatuscode = "0";
        $serverstatusdes = $exception->getMessage();
      }

      return redirect()->route('admin-keranjang-produk-detail', $transaksi->id_instansi)->with('success', 'Transaction Edited');
  }

  public function confirmTransaction(Request $request, $id)
  {
    // return $request;
      $transaksi = KeranjangProduk::find($id);
      $produk = Produk::where('slug', $transaksi->slug)->first();
      $ujian = KeranjangProduk::find($id)
      ->where('slug', 'like', $transaksi->slug)
      ->first();

      $data = array();
      $data['email'] = $transaksi->user->email;
      $data['subject'] = 'Terima Kasih, Pembayaran Anda Sudah Kami Terima';
      $data['nama'] = $transaksi->user->name;
      $data['produk'] = str_replace('-', " ", strtoupper($produk->nama_produk));
      $data['isregonly'] = "2";
      $data['mail_cc_1'] = env('MAIL_CC_1');
      $data['mail_cc_2'] = env('MAIL_CC_2');
      $data['mail_cc_3'] = env('MAIL_CC_3');

      if ($transaksi->slug == $ujian->slug) {
        $data['isregonly'] = '3';
      }

      try {
        Mail::send('mail', $data, function ($message) use ($data) {
          $message->to($data["email"], $data["nama"])
            ->subject($data["subject"])
            ->cc($data["mail_cc_1"], $data["mail_cc_2"], $data["mail_cc_3"]);
        });
      } catch (JWTException $exception) {
        $serverstatuscode = "0";
        $serverstatusdes = $exception->getMessage();
      }

      $transaksi->status = $request->confirm;
      if($request->tenor == "Full"){
        $transaksi->payment_status = 'Paid';
        $transaksi->status = 2;
      }else{
        if($request->tenor == '25'){
          $transaksi->status = 5;
        }elseif($request->tenor == '50'){
          $transaksi->status = 3;
        }elseif($request->tenor == '75'){
          $transaksi->status = 4;
        }
        $transaksi->payment_status = 'Cicilan';
      }

      if($transaksi->type_diskon == 'Persen'){
        $disc = ($transaksi->harga_kelas/100) * $transaksi->diskon;
        $angka_diskon = $transaksi->harga_kelas - $disc;
      }else {
        $angka_diskon = $transaksi->harga_kelas - $transaksi->diskon;
      }

      $total = $transaksi->total_price;
      if($request->tenor != "Full"){
        $afterDiskon =  $angka_diskon - $transaksi->total_price;
        $afterTenor = $angka_diskon * $request->tenor/100;

        $total = $afterTenor;
      }else{
        $total = $angka_diskon;
      }

      if($transaksi->voucher_text_id){
        $discvoucher = Diskon::where('id',$transaksi->voucher_text_id)->first();
        if($discvoucher){
            $total = $total - $discvoucher->nilai;
        }
      }

      $transaksi->tenor = $request->tenor;
      $transaksi->update();

      return redirect()->route('admin-keranjang-produk-detail', $transaksi->id_instansi)->with('success', 'Transaction Confirmed');
  }

  public function destroy(Request $request)
  {
      $products = KeranjangProduk::find($request->id);

      $mail = [
        'username' => $products->username,
        'nama' => $products->user->name,
        'mail_cc_1' => env('MAIL_CC_1')
      ];

      try {
        Mail::to(validate_email($mail["username"]) ? $mail["username"] : "info@iceducation.co.id")
          ->cc($mail["mail_cc_1"])
          ->send(new CancelTransactionMail($mail));
      } catch (JWTException $exception) {
        $serverstatuscode = "0";
        $serverstatusdes = $exception->getMessage();
      }

      $data = [
        'id' => $request->id,
        'slug' => $products->slug,
        'username' => $products->username,
        'aktif' => $products->aktif,
        'status' => $products->status,
        'diskon' => $products->diskon,
        'sertifikat' => $products->sertifikat,
        'note' => $request->noteDelete
      ];

      TrashKeranjangProduk::create($data);
      $products->delete();

      return redirect()->route('admin-keranjang-produk-detail', $products->id_instansi)->with('success', 'Transaction Deleted and Successfully send email information');
  }

  public function invoice(Request $request) {
      $keranjangBaru = KeranjangProduk::where('username', auth()->user()->username)
      ->where('slug', 'not like', 'ujian%')
      ->where('status', '1')->latest()
      ->first();

      $is_ujian = 0;
      
      if (!$keranjangBaru) {
        $keranjangBaru = KeranjangProduk::where('username', auth()->user()->username)
        ->where('slug', 'like', 'ujian%')
        ->where('status', '1')->latest()
        ->first();

        $is_ujian = 1;
      }

      return view('auth.includes.invoice', [
        'keranjang' => $keranjangBaru,
        'is_ujian' => $is_ujian,
      ]);
  }

  public function voucherVerif(Request $request) {
      $keranjangBaru = KeranjangProduk::where('username', Auth::user()->username)->first();
      $voucherDiskon = Diskon::where('kode', $request->input('voucher'))->first();

      $produk = Produk::where('slug', $keranjangBaru->slug)->first();
      $nama_produk = str_replace('-', " ", strtoupper($produk->nama_produk));
      $isOnline = $produk->online == '1' ? 'Online' : '';

      $data = array();
      $data['email'] = Auth::user()->email;
      $data['subject'] = 'Info Pembelian Kelas dan Pembayaran';
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
      $data['no_invoice'] = $keranjangBaru->no_invoice;
      $data['produk'] = $produk->nama_produk;
      $data['isregonly'] = "0";
      $data['mail_cc_1'] = env('MAIL_CC_1');
      $data['mail_cc_2'] = env('MAIL_CC_2');
      $data['mail_cc_3'] = env('MAIL_CC_3');

      if ($request->input('voucher') && $voucherDiskon->is_active == '1') {
        $setelahDiskon = $produk->harga - $voucherDiskon->nilai;
        $data['diskon'] = $produk->diskon;
        $data['sum_diskon'] = $voucherDiskon->nilai;
        $data['total'] = $setelahDiskon;

        $keranjangBaru->diskon = $setelahDiskon;
        $keranjangBaru->save();
      }

      $pdf = PDF::loadView('invoice', $data);
      $pdf->setPaper('A4', 'portrait');

      try {
          Mail::send('mail', $data, function ($message) use ($data, $pdf) {
              $message->to($data["email"], $data["nama"])
                  ->subject($data["subject"])
                  ->cc($data["mail_cc_1"], $data["mail_cc_2"], $data["mail_cc_3"])
                  ->attachData($pdf->output(), "invoice.pdf");
          });
      } catch (JWTException $exception) {
          $serverstatuscode = "0";
          $serverstatusdes = $exception->getMessage();
      }

      return redirect()->route('transaksi')->with('success', 'Silahkan cek email yang terdaftar untuk mendapatkan informasi petunjuk pembayaran');
  }

  public function potongHarga(Request $request)
  {
      $diskon = Diskon::where('kode', $request->kodeInput)
      ->where('is_active', '1')
      ->first();
      $totalAwal = intval($request->hargaAwal);
      $totalAkhir = $totalAwal - $diskon->nilai;

      $diskonConverted = convert_to_rupiah($diskon->nilai);
      $totalConverted = convert_to_rupiah($totalAkhir);

      return response()->json([
        'diskon' => $diskon,
        'hargaRupiah' => $diskonConverted,
        'setelahPotong' => $totalConverted
      ]);
  }
  public function invoiceBaru(Request $request, $id)
  {
      try {
          $transaksi = KeranjangProduk::with('user','Voucher')->where('id', $id)->first();
          $produk = Produk::where('slug', $transaksi->slug)->first();
          $nama_produk = str_replace('-', " ", strtoupper($produk->nama_produk));
          $isOnline = $produk->online == '1' ? 'Online' : '';
          $tanggal = date('Y-m-d');

          $userLogin = User::where('email', $transaksi->username)->first();
          $instansiCheck = Kerjasama::where('id', $userLogin->kerjasama_id)->first();
          if(!$transaksi){
            Alert::warning('Warning', 'Internal Server Error, Data Not Found');
            return redirect()->back();
          }else{
              $pdf = Pdf::loadview('invoice_download',['instansi' => $instansiCheck, 'transaksi'=>$transaksi, 'nama_produk'=>$nama_produk, 'tanggal'=>$tanggal, 'isOnline'=>$isOnline, 'produk'=> $produk]);
              return $pdf->download($transaksi->no_invoice.'.pdf');
              Alert::success('Berhasil', 'Invoice Anda Berhasil Didownload');
          }

      } catch (\Throwable $th) {
          return $th;
          Alert::warning('Warning', 'Internal Server Error, Chat Our Administrator');
          return redirect()->back();
      }

  }
}
