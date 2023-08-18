<?php

namespace App\Http\Controllers\Pemateri;

use App\Http\Controllers\Controller;
use App\Models\BankSoalUjian;
use App\Models\Materi;
use App\Models\Pemateri;
use App\Models\Produk;
use Illuminate\Http\Request;

class UjianController extends Controller
{
    public function bankSoal()
    {
        $user = Pemateri::where('user_id', auth()->user()->id)->first();
        $bankSoal = BankSoalUjian::whereIn('kode_soal', json_decode($user->kode_soal))->get();

        return view('pemateri.pages.ujian.bank-soal', [
            'bankSoal' => $bankSoal
        ]);
    }
}
