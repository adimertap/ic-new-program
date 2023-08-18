<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KeranjangProduk;
use App\Models\Sertifikat;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $brevet = KeranjangProduk::where('slug', 'like', 'brevet-ab%')
                    ->where('created_at', now()->isoFormat('Y-m-d'))
                    ->count();

        $user = User::all()->count();

        $req_sertif = Sertifikat::where('request', 1)->count();

        return view('admin.pages.dashboard', [
            'brevet' => $brevet,
            'user' => $user,
            'reqSertif' => $req_sertif,
        ]);
    }

    public function chartBrevet()
    {
        $jan = KeranjangProduk::where('slug', 'like', 'brevet%')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', 1)
            ->count();

        $feb = KeranjangProduk::where('slug', 'like', 'brevet%')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', 2)
            ->count();

        $mar = KeranjangProduk::where('slug', 'like', 'brevet%')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', 3)
            ->count();

        $apr = KeranjangProduk::where('slug', 'like', 'brevet%')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', 4)
            ->count();

        $mei = KeranjangProduk::where('slug', 'like', 'brevet%')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', 5)
            ->count();

        $jun = KeranjangProduk::where('slug', 'like', 'brevet%')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', 6)
            ->count();

        $jul = KeranjangProduk::where('slug', 'like', 'brevet%')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', 7)
            ->count();

        $agu = KeranjangProduk::where('slug', 'like', 'brevet%')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', 8)
            ->count();

        $sep = KeranjangProduk::where('slug', 'like', 'brevet%')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', 9)
            ->count();

        $okt = KeranjangProduk::where('slug', 'like', 'brevet%')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', 10)
            ->count();

        $nov = KeranjangProduk::where('slug', 'like', 'brevet%')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', 11)
            ->count();

        $des = KeranjangProduk::where('slug', 'like', 'brevet%')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', 12)
            ->count();

        $data = [ $jan, $feb, $mar, $apr, $mei, $jun, $jul, $agu, $sep, $okt, $nov, $des];

        return response()->json($data);
    }
}
