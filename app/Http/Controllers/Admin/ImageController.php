<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use App\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $image = Image::where('lien', 'LIKE', "%$keyword%")
                ->orWhere('produit', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $image = Image::latest()->paginate($perPage);
        }

        return view('admin.image.index', compact('image'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        $file = $request->file('image');
        $name = time().$file->getClientOriginalName();
        Storage::putfile('images', $file);
        $lien = 'images/images/produit_'.$requestData['produit'];
        $file->move($lien, $name);
        Image::insert(['lien'=> $lien.'/'.$name, 'produit'=> $requestData['produit']]);
        return redirect()->back()->with('flash_message', 'Image Ajoutée!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $image = Image::findOrFail($id);

        return view('admin.image.show', compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $image = Image::findOrFail($id);

        return view('admin.image.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $image = Image::findOrFail($id);
        $image->update($requestData);

        return redirect('admin/image')->with('flash_message', 'Image modifiée!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $image_path= Image::findOrFail($id)->lien;
        
        Storage::delete($image_path);
        //dd($image_path);
        Image::destroy($id);
        return redirect()->back()->with('flash_message', 'Image Supprimée!');
    }
}
