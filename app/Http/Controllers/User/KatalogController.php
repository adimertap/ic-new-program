<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function katalogBrevet (Request $request)
    {
        return view('user.pages.katalogBrevet');
    }

    public function katalogUSKP (Request $request)
    {
        return view('user.pages.katalogUSKP');
    }

    public function katalogInHouse (Request $request)
    {
        return view('user.pages.katalogInHouse');
    }

    public function katalogSeminar (Request $request)
    {
        return view('user.pages.katalogSeminar');
    }

    public function beli (Request $request)
    {
        return view('user.pages.katalog_beli');
    }

    public function informasi (Request $request)
    {
        return view('user.pages.informasi_beli');
    }
}
