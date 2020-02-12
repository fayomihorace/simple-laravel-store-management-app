<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Produit;
use App\Image;
use App\Categorie;
use DB;
use Session;
use Illuminate\Http\Request;

class ProduitController extends Controller
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
            $produit = Produit::join('geststock_categories', 'geststock_categories.id', '=', 'geststock_produits.categorie' )
                ->select('geststock_produits.nom', 'geststock_produits.description', 'geststock_produits.id', 'geststock_produits.stock', 'geststock_produits.stock_details', 'geststock_categories.nom as categorie')
                ->where('nom', 'LIKE', "%$keyword%")
                ->orWhere('categorie', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('stock', 'LIKE', "%$keyword%")
                ->orWhere('stock_details', 'LIKE', "%$keyword%")
                ->orderby('geststock_produits.created_at','asc')
                ->paginate($perPage);
        } else {
            $produit = Produit::join('geststock_categories', 'geststock_categories.id', '=', 'geststock_produits.categorie' )
            ->select('geststock_produits.nom', 'geststock_produits.description', 'geststock_produits.id', 'geststock_produits.stock', 'geststock_produits.stock_details', 'geststock_categories.nom as categorie')
            ->orderby('geststock_produits.created_at','asc')
            ->paginate($perPage);
        }
        //dd($produit);
        $categories = Categorie::all();
        return view('admin.produit.index', compact('produit'))->with(['categories'=>$categories]) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('admin.produit.create')->with('categories', $categories);
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
        //$produit=Produit::create($requestData);
        DB::connection(session::get('geststock_database'))->table('geststock_produits')->insert(['nom' => $requestData['nom'], 'categorie' => $requestData['categorie'], 'description' => $requestData['description'], 'stock'=> 0, 'stock_details'=> $requestData['stock_details'] ]);
    
        return redirect('admin/produit')->with('flash_message', 'Produit ajouté!');
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
        $images = Image::where(['produit'=>$id])->get();
        $produit = Produit::join('geststock_categories', 'geststock_categories.id', '=', 'geststock_produits.categorie' )
        ->select('geststock_produits.nom', 'geststock_produits.description', 'geststock_produits.id', 'geststock_produits.stock', 'geststock_produits.stock_details', 'geststock_categories.nom as categorie')
        ->findOrFail($id);

        return view('admin.produit.show', compact('produit'))->with(['images'=>$images]) ;
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
        $produit = Produit::findOrFail($id);
        $categories = Categorie::all();
        return view('admin.produit.edit', compact('produit'))->with('categories', $categories);
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
        $produit = Produit::findOrFail($id);
        $produit->update($requestData);

        return redirect('admin/produit')->with('flash_message', 'Produit modifié!');
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
        if( Produit::join("geststock_mouvements", "geststock_mouvements.produit", "=", "geststock_produits.id")
            ->where( ['geststock_produits.id'=>  $id ])->exists()){
            return redirect()->back()->with('error_message', 'Impossible de supprimer ce produit car au moins un mouvement a été effectué avec ce produit !!');  
        }
        if( Produit::join("geststock_ajout_stocks", "geststock_ajout_stocks.produit", "=", "geststock_produits.id")
            ->where( ['geststock_produits.id'=>  $id ])->exists()){
            return redirect()->back()->with('error_message', 'Impossible de supprimer ce produit car au moins un ajout de stock a été effectué avec ce produit !!');  
        }
        
        Produit::destroy($id);
        return redirect('admin/produit')->with('flash_message', 'Produit supprimé!');
    }
}
