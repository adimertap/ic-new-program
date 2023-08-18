<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\TrashUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $req)
    {
        $users = User::orderBy('updated_at', 'desc')->where('role', '!=', '5')->get();
        return view('admin.pages.master.peserta', [
            'users' => $users,
        ]);
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
