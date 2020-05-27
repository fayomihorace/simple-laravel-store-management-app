<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Categorie;
use App\CategorieImage;
use Illuminate\Http\Request;

class CategorieController extends Controller
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
            $categorie = Categorie::where('nom', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
        } else {
            $categorie = Categorie::latest()->paginate($perPage);
        }

        return view('admin.categorie.index', compact('categorie'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categorie.create');
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

        if(!Categorie::where( ['nom'=>  $requestData['nom'] ])->exists()){
            $categorie=Categorie::create($requestData);
            $categorie->update($requestData);
            return redirect('admin/categorie')->with('flash_message', 'Categorie ajoutée!');
        }
        return redirect()->back()->with('error_message', 'Une catégorie avec le nom <<'.$requestData['nom'].'>> existe déjà !!');  
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
        $images = CategorieImage::where(['categorie'=>$id])->get();
        $categorie = Categorie::findOrFail($id);

        return view('admin.categorie.show', compact('categorie'))->with(['images'=>$images]) ;
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
        $categorie = Categorie::findOrFail($id);

        return view('admin.categorie.edit', compact('categorie'));
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
        
        $categorie = Categorie::findOrFail($id);
        $categorie->update($requestData);

        return redirect('admin/categorie')->with('flash_message', 'Categorie modifiée!');
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
        if( Categorie::join("geststock_produits", "geststock_produits.categorie", "=", "geststock_categories.id")
            ->join("geststock_mouvements", "geststock_mouvements.produit", "=", "geststock_produits.id")
            ->where( ['geststock_categories.id'=>  $id ])->exists()){
            return redirect()->back()->with('error_message', 'Impossible de supprimer cette catégorie car au moins un mouvement a été effectué avec un  produit de cette catégorie !!');  
        }
        if( Categorie::join("geststock_produits", "geststock_produits.categorie", "=", "geststock_categories.id")
            ->join("geststock_ajout_stocks", "geststock_ajout_stocks.produit", "=", "geststock_produits.id")
            ->where( ['geststock_categories.id'=>  $id ])->exists()){
            return redirect()->back()->with('error_message', 'Impossible de supprimer cette catégorie car au moins un ajout de stock a été effectué pour un produit de cette catégorie !!');  
        }
        
        Categorie::destroy($id);
        return redirect('admin/categorie')->with('flash_message', 'Categorie supprimée!');
    }
}
//geststock_ajout_stocks