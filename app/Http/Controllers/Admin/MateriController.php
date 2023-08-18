<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Produk;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index()
    {
        $materi = Materi::all();
        return view('admin.pages.master.materi', [
            'materi' => $materi,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'harga' => 'required'
        ]);

        $newMateri = $request->only(['description', 'active']);
        $newMateri['created_by'] = 'admin';

        $newProdukMateri = $request->only(['harga', 'nama_produk']);
        $newProdukMateri['kelas'] = $request->description;
        $newProdukMateri['created_by'] = 'admin';
        $newProdukMateri['akses_ujian'] = 0;

        if (!$request->id) {
            $slug = slug($request->description).'-'.now()->toDateString();
            $newMateri['slug'] = $slug;
            $newProdukMateri['slug'] = $slug;

            Materi::create($newMateri);
            Produk::create($newProdukMateri);

            return redirect()->route('admin-materi')->with('success', 'New Materi and Materi Product Added');
        } else {
            $materi = Materi::find($request->id);
            $materi->update($newMateri);

            Produk::where('slug', $materi->slug)
                ->update($newProdukMateri);
            
            return redirect()->route('admin-materi')->with('success', $request->description." Edited");
        }

        return redirect()->route('admin-materi')->with('error', 'Error When Added New Materi and Materi Product');
    
    }

    public function edit($id)
    {
        $materi = Materi::with('produk')->where('id', $id)->first();

        return response()->json($materi);
    }

    public function destroy($id)
    {
        $materi = Materi::find($id);
        
        Produk::where('slug', $materi->slug)->delete();
        $materi->delete();

        return redirect()->route('admin-materi')->with('success', 'Materi Deleted');
    }
}
