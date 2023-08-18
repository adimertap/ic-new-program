<?php

namespace App\Http\Controllers\Pemateri;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pemateri;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Pemateri::where('user_id', auth()->user()->id)->first();

        return view('pemateri.pages.dashboard', [
            'user' => $user,
        ]);
    }

}
