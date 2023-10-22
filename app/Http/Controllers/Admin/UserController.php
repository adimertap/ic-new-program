<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\TrashUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dapodik;
use Alert;
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
