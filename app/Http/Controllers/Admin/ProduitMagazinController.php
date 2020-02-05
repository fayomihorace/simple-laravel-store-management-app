<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ProduitMagazin;
use Illuminate\Http\Request;

class ProduitMagazinController extends Controller
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
            $produitmagazin = ProduitMagazin::where('produit', 'LIKE', "%$keyword%")
                ->orWhere('magazin', 'LIKE', "%$keyword%")
                ->orWhere('stock', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $produitmagazin = ProduitMagazin::latest()->paginate($perPage);
        }

        return view('admin.produit-magazin.index', compact('produitmagazin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.produit-magazin.create');
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
        
        $produitmagazin=ProduitMagazin::create($requestData);
        $produitmagazin->update($requestData);
        return redirect('admin/produit-magazin')->with('flash_message', 'ProduitMagazin ajouté!');
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
        $produitmagazin = ProduitMagazin::findOrFail($id);

        return view('admin.produit-magazin.show', compact('produitmagazin'));
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
        //$produitmagazin = ProduitMagazin::findOrFail($id);

        return view('admin.produit-magazin.edit', compact('produitmagazin'));
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
        
        /*$requestData = $request->all();
        
        $produitmagazin = ProduitMagazin::findOrFail($id);
        $produitmagazin->update($requestData);*/

        return redirect('admin/produit-magazin')->with('flash_message', 'ProduitMagazin updated!');
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
        ProduitMagazin::destroy($id);

        return redirect('admin/produit-magazin')->with('flash_message', 'ProduitMagazin supprimé!');
    }
}
