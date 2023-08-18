<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TrashKeranjangProduk;
use App\Models\TrashUsers;
use App\Models\User;

class TrashController extends Controller
{
    public function keranjangProduk()
    {
        $trashProducts = TrashKeranjangProduk::with(['produk', 'user'])->orderBy('updated_at', 'desc')->get();
        return view('admin.pages.trash.trash-keranjang-produk', [
            'trashProducts' => $trashProducts,
        ]);

    }

    public function users()
    {
        $trashUsers = TrashUsers::orderBy('updated_at', 'desc')->get();
        return view('admin.pages.trash.trash-users', [
            'trashUsers' => $trashUsers,
        ]);
    }
}
