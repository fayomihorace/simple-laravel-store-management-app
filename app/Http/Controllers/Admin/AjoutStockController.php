<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AjoutStock;
use App\Fournisseur;
use App\Magazin;
use App\Produit;
use Session;
use DB;
use Illuminate\Http\Request;

class AjoutStockController extends Controller
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
            $ajoutstock = AjoutStock::join('geststock_produits', 'geststock_produits.id', '=', 'geststock_ajout_stocks.produit' )
                ->join('geststock_fournisseurs', 'geststock_fournisseurs.id', '=', 'geststock_ajout_stocks.fournisseur' )
                ->join('geststock_magazins', 'geststock_magazins.id', '=', 'geststock_ajout_stocks.magazin' )
                ->select('geststock_ajout_stocks.id', 'geststock_ajout_stocks.created_at', 'geststock_produits.nom as produit', 'geststock_ajout_stocks.quantite', 'geststock_ajout_stocks.prix', 'geststock_fournisseurs.nom as fournisseur', 'geststock_magazins.nom  as magazin')
                ->where('produit', 'LIKE', "%$keyword%")
                ->orWhere('quantite', 'LIKE', "%$keyword%")
                ->orWhere('prix', 'LIKE', "%$keyword%")
                ->orWhere('magazin', 'LIKE', "%$keyword%")
                ->orWhere('fournisseur', 'LIKE', "%$keyword%")
                ->orderby('geststock_ajout_stocks.created_at','asc')
                ->paginate($perPage);
        } else {
            $ajoutstock = AjoutStock::join('geststock_produits', 'geststock_produits.id', '=', 'geststock_ajout_stocks.produit' )
            ->join('geststock_fournisseurs', 'geststock_fournisseurs.id', '=', 'geststock_ajout_stocks.fournisseur' )
            ->join('geststock_magazins', 'geststock_magazins.id', '=', 'geststock_ajout_stocks.magazin' )
            ->select('geststock_ajout_stocks.id', 'geststock_ajout_stocks.created_at', 'geststock_produits.nom as produit', 'geststock_ajout_stocks.quantite', 'geststock_ajout_stocks.prix', 'geststock_fournisseurs.nom as fournisseur', 'geststock_magazins.nom  as magazin')
            ->orderby('geststock_ajout_stocks.created_at','asc')
            ->paginate($perPage);
        }
        $magazins = Magazin::all();
        $produits = Produit::all();
        $fournisseurs = Fournisseur::all();
        return view('admin.ajout-stock.index', compact('ajoutstock'))->with(['magazins'=>$magazins, 'fournisseurs'=>$fournisseurs, 'produits'=>$produits]) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $magazins = Magazin::all();
        $produits = Produit::all();
        $fournisseurs = Fournisseur::all();
        return view('admin.ajout-stock.create')->with(['magazins'=>$magazins, 'fournisseurs'=>$fournisseurs, 'produits'=>$produits]) ;
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
        
        //update produit magazin
        $old_stock_in_magazin = DB::connection(session::get('geststock_database'))->table('geststock_produit_magazins')->
        where(['magazin'=> $requestData['magazin'], 'produit'=> $requestData['produit']])->get();
        echo($old_stock_in_magazin);

        if( sizeof($old_stock_in_magazin)  != 0){
            DB::connection(session::get('geststock_database'))->table('geststock_produit_magazins')
            ->where(['produit' => $requestData['produit'], 'magazin'=> $requestData['magazin']])
            ->increment('stock', intval($requestData['quantite']) ); 
        }
        else{
            DB::connection(session::get('geststock_database'))->table('geststock_produit_magazins')->insert(['produit' => $requestData['produit'], 'magazin'=> $requestData['magazin'], 'stock'=> intval($requestData['quantite']) ]);
        }
        
        DB::connection(session::get('geststock_database'))->table('geststock_produits')
            ->where(['id' => $requestData['produit']])
            ->increment('stock', intval($requestData['quantite']) ); 

        DB::connection(session::get('geststock_database'))->table('geststock_ajout_stocks')->insert(['produit' => $requestData['produit'], 'quantite' => $requestData['quantite'], 'prix' => $requestData['prix'], 'magazin'=> $requestData['magazin'], 'fournisseur'=> $requestData['fournisseur'] ]);
    
        return redirect('admin/ajout-stock')->with('flash_message', 'AjoutStock effectué!');
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
        $ajoutstock = AjoutStock::join('geststock_produits', 'geststock_produits.id', '=', 'geststock_ajout_stocks.produit' )
        ->join('geststock_fournisseurs', 'geststock_fournisseurs.id', '=', 'geststock_ajout_stocks.fournisseur' )
        ->join('geststock_magazins', 'geststock_magazins.id', '=', 'geststock_ajout_stocks.magazin' )
        ->select('geststock_ajout_stocks.id', 'geststock_ajout_stocks.created_at', 'geststock_produits.nom as produit', 'geststock_ajout_stocks.quantite', 'geststock_ajout_stocks.prix', 'geststock_fournisseurs.nom as fournisseur', 'geststock_magazins.nom  as magazin')
        ->findOrFail($id);

        return view('admin.ajout-stock.show', compact('ajoutstock'));
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
        $ajoutstock = AjoutStock::findOrFail($id);
        
        $magazins = Magazin::all();
        $fournisseurs = Fournisseur::all();
        return view('admin.ajout-stock.edit', compact('ajoutstock'))->with(['magazins'=>$magazins, 'produits'=>$produits, 'fournisseurs'=>$fournisseurs]) ;
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
        
        $ajoutstock = AjoutStock::findOrFail($id);
        $ajoutstock->update($requestData);
        return redirect('admin/ajout-stock')->with('flash_message', 'AjoutStock updated!');
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
        $ajoutstock = AjoutStock::findOrFail($id);
        AjoutStock::destroy($id);

        DB::connection(session::get('geststock_database'))->table('geststock_produit_magazins')
            ->where(['produit' => $ajoutstock->produit, 'magazin'=> $ajoutstock->magazin])
            ->decrement('stock', $ajoutstock->quantite ); 
        
        DB::connection(session::get('geststock_database'))->table('geststock_produits')
            ->where(['id' => $ajoutstock->produit])
            ->decrement('stock', $ajoutstock->quantite); 

        return redirect('admin/ajout-stock')->with('flash_message', 'AjoutStock supprimé!');
    }
}
