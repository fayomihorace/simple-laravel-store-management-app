<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use App\CategorieImage;
use Illuminate\Http\Request;

class CategorieImageController extends Controller
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
            $categorieimage = CategorieImage::where('lien', 'LIKE', "%$keyword%")
                ->orWhere('categorie', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $categorieimage = CategorieImage::latest()->paginate($perPage);
        }

        return view('admin.categorie-image.index', compact('categorieimage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categorie-image.create');
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
        $name = time().'.'.$file->getClientOriginalExtension();
        Storage::putfile('images', $file);
        $lien = 'images/images/categorie_'.$requestData['categorie'];
        $file->move($lien, $name);
        CategorieImage::insert(['lien'=> $lien.'/'.$name, 'categorie'=> $requestData['categorie']]);
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
        $categorieimage = CategorieImage::findOrFail($id);

        return view('admin.categorie-image.show', compact('categorieimage'));
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
        $categorieimage = CategorieImage::findOrFail($id);

        return view('admin.categorie-image.edit', compact('categorieimage'));
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
        
        $categorieimage = CategorieImage::findOrFail($id);
        $categorieimage->update($requestData);

        return redirect('admin/categorie-image')->with('flash_message', 'Image modifiée!');
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
        $image_path= CategorieImage::findOrFail($id)->lien;
        
        Storage::delete($image_path);
        CategorieImage::destroy($id);

        return redirect()->back()->with('flash_message', 'Image Supprimée!');
    }
}
