<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produk;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galleries = Gallery::all();

        return view('admin.pages.master.galeri', [
            'galleries' => $galleries,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'required|string',
            'title' => 'required|string',
            'image' => 'image|mimes:png,jpg,jpeg',
            'active' => 'required'
        ]);

        $newGallery = $request->except(['id', '_token']);
        
        if (!$request->id) {
            $newImage = $request->image;
    
            $newImageName = Str::random(10).'.'.$newImage->getClientOriginalExtension();
            Storage::disk('galleries')->put($newImageName, file_get_contents($newImage));
    
            $newGallery['image'] = $newImageName;
            
            Gallery::create($newGallery);

            return redirect()->route('admin-gallery')->with('success', 'New Galleri Added');

        }

        if ($request->image) {
            $gallery= Gallery::find($request->id);
            Storage::disk('galleries')->delete($gallery->image);

            $newImage = $request->image;
    
            $newImageName = Str::random(10).'.'.$newImage->getClientOriginalExtension();
            Storage::disk('galleries')->put($newImageName, file_get_contents($newImage));
    
            $newGallery['image'] = $newImageName;

            $gallery->update($newGallery);

            return redirect()->route('admin-gallery')->with('success', $gallery->title.' Edited');
        } else {
            $gallery = Gallery::find($request->id);

            $gallery->update($newGallery);

            return redirect()->route('admin-gallery')->with('success', $gallery->title.' Edited');
        }

        return redirect()->route('admin-gallery')->with('error', 'Error When Edited or Added');
    }

    public function edit($id)
    {
        $galleries = Gallery::find($id);
        return response()->json($galleries);
    }

    public function destroy($id)
    {
        Gallery::destroy($id);

        return redirect()->route('admin-gallery')->with('success', 'Gallery Deleted');
    }
}
