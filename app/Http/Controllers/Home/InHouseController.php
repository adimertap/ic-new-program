<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\MasterHeaderKelas;
use App\Models\MetaDescription;
use Illuminate\Http\Request;

class InHouseController extends Controller
{
    public function index()
    {
        $header = MasterHeaderKelas::where('kelas','Inhouse')->where('section', null)->first();
        $judul = MasterHeaderKelas::where('kelas','Inhouse')->where('section', 'Judul')->first();
        $meta = MetaDescription::where('pages', 'InHouse')->first();


        return view('home.pages.inhouse', compact('header','judul','meta'));
    }
}
