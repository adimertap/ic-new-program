<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\TrashUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dapodik;
use Alert;
use App\Models\KeranjangProduk;
use App\Models\TrashKeranjangProduk;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $req)
    {
        $users = User::orderBy('users.updated_at', 'desc')->where('users.role', '!=', '5')->get();
        return view('admin.pages.master.peserta', [
            'users' => $users,
        ]);
    }

    public function dapodik($id){
        try {
            $dapodik = Dapodik::with('User')->where('user_id', $id)->first();
            if($dapodik){
                return view('admin.pages.master.dapodikPeserta', compact('dapodik'));
            }else{
                Alert::warning('Warning', 'Data dapodik belum terisi oleh User');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            Alert::warning('Warning', 'Internal Server Error, Data Not Found');
            return redirect()->back();
        }     
    }

    public function resetPassword(Request $request){
        try {
            if($request->password != $request->n_password){
                Alert::warning('Warning', 'Password Tidak Sama, Ulangi Kembali');
                return redirect()->back();
            }

            $hashedPassword = Hash::make($request->password);
            $user = User::where('id', $request->user_id)->first();
            if($user){
                $user->update([
                    'password' => $hashedPassword
                ]);

                Alert::success('Success', 'Berhasil Merubah Password');
                return redirect()->back();
            }else{
                Alert::warning('Warning', 'Internal Server Error, Data Not Found');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return $th;
            Alert::warning('Warning', 'Internal Server Error, Data Not Found');
            return redirect()->back();
        }
    }

    public function delete(Request $req, $id)
    {
        $data = User::find($id);
        $params = array();
        $params['id'] = $data['id'];
        $params['name'] = $data['name'];
        $params['username'] = $data['username'];
        $params['email'] = $data['email'];
        $params['password'] = $data['password'];
        $params['image_name'] = $data['image_name'];
        $params['role'] = $data['role'];
        $params['active'] = $data['active'];
        $params['remember_token'] = $data['remember_token'];
        $params['created_at'] = $data['created_at'];
        $params['updated_at'] = $data['updated_at'];
        $params['no_hp'] = $data['no_hp'];
        $params['pekerjaan'] = $data['pekerjaan'];

        $keranjang = KeranjangProduk::where('username', $data->username)->get();
        for ($i = 0; $i < count($keranjang); $i++) {
            $item = $keranjang[$i];

            $kr = new TrashKeranjangProduk();
            $kr->username = $item->username;
            $kr->status = $item->status;
            $kr->diskon = $item->diskon;
            $kr->slug = $item->slug;
            $kr->sertifikat = $item->sertifikat;
            $kr->aktif = $item->aktif;
            $kr->note = $item->note;
            $kr->no_invoice = $item->no_invoice;
            $kr->total_price = $item->total_price;
            $kr->payment_status = $item->payment_status;
            $kr->tenor = $item->tenor;
            $kr->type_pembayaran = $item->type_pembayaran;
            $kr->midtrans_url = $item->midtrans_url;
            $kr->midtrans_booking_code = $item->midtrans_booking_code;
            $kr->save();

            $update = KeranjangProduk::find($item->id);
            $update->aktif = 0;
            $update->update();
        }

        if (TrashUsers::updateOrCreate($params)) {
            $data->delete();

            $path = public_path().'/images/users/'.$data->image_name;
            if (!empty($data->image_name) && file_exists($path)) {
                unlink($path);
            }

            return redirect()->route('admin-user')->with('success' ,'Berhasil Menghapus');
        }
        
        return redirect()->back()->with('error', 'Gagal Menghapus');
    }
}
