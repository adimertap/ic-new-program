<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\MasterHeader;
use App\Models\MasterTenagaPendidik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;

class BerandaController extends Controller
{
    public function index()
    {
        $gallery = Gallery::latest()->take(4)->get();
        $home_header = MasterHeader::where('pages','Home')->where('section','Header')->where('section_3', null)->first();
        $home_title = MasterHeader::where('pages','Home')->where('section','Header')->where('section_3', 'Judul')->first();
        $home_about = MasterHeader::where('pages','Home')->where('section','About')->where('section_3', null)->first();
        $home_brevet = MasterHeader::where('pages','Home')->where('section','Kelas')->where('section_2','Brevet')->where('section_3', null)->first();
        $home_seminar =  MasterHeader::where('pages','Home')->where('section','Kelas')->where('section_2','Seminar')->where('section_3', null)->first();
        $home_house =  MasterHeader::where('pages','Home')->where('section','Kelas')->where('section_2','Inhouse')->where('section_3', null)->first();
        $home_uskp =  MasterHeader::where('pages','Home')->where('section','Kelas')->where('section_2','USKP')->where('section_3', null)->first();
        $home_sertif =  MasterHeader::where('pages','Home')->where('section','Sertifikat')->where('section_3', null)->first();
        $home_judul =  MasterHeader::where('pages','Home')->where('section','Header')->where('section_3', 'Judul')->first();

        return view('home.pages.beranda', [
            'gallery' => $gallery,
            'home_header' => $home_header,
            'home_about' => $home_about,
            'home_brevet' => $home_brevet,
            'home_seminar' => $home_seminar,
            'home_house' => $home_house,
            'home_uskp' => $home_uskp,
            'home_sertif' => $home_sertif,
            'home_judul' => $home_judul,
            'home_title' => $home_title
        ]);
    }

    public function galeri()
    {
        $gallery = Gallery::latest()->get();
        return view('home.pages.galeri', [
            'gallery' => $gallery,
        ]);
    }

    public function teams()
    {
        $team = MasterTenagaPendidik::where('status', '1')->get();
        return view('home.pages.teams',compact('team'));
    }

    public function dashboard_check(){

        try {
            if(Auth::user()->role == '2'){
                return redirect()->route('user-dashboard');
            }else{
                return redirect()->route('admin-dashboard');
            }
        } catch (\Throwable $th) {
            Alert::warning('Warning', 'Internal Server Error, Data Not Found');
            return redirect()->back();
        }
    }
}
