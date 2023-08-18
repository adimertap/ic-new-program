<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Pemateri;
use Illuminate\Support\Facades\Hash;

class PemateriController extends Controller
{
    public function index(Request $req)
    {
        $users = Pemateri::all();
        $materi = Materi::all();

        return view('admin.pages.master.pemateri', [
            'users' => $users,
            'materi' => $materi,
        ]);
    }

    public function create(Request $req)
    {
        try {
            User::create([
                'name' => $req->name,
                'username' => $req->username,
                'email' => $req->username,
                'active' => '1',
                'no_hp' => $req->no_hp,
                'role' => '5',
                'password' => Hash::make($req->password)
            ]);
    
            $id_pemateri = User::where('username', $req->username)->value('id');
    
            Pemateri::create([
                'user_id' => $id_pemateri,
                'materi_id' => $req->materi_id,
                'kode_soal' => json_encode($req->kode_soal),
            ]);

            return redirect()->route('admin-pemateri')->with('success' ,'Berhasil Membuat Pemateri');

        } catch (\Throwable $th) {

            return redirect()->route('admin-pemateri')->with('error' ,'Gagal Membuat Pemateri');
        }    
    }

    public function delete($id)
    {
        $pemateri = Pemateri::find($id);
        $users = User::find($pemateri->user_id);

        try {
            $users->delete();
            $pemateri->delete();

            return redirect()->route('admin-pemateri')->with('success' ,'Berhasil Menghapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal Menghapus '.$th);
        }
    }
}
