<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Mouvement;
use App\Produit;
use App\Magazin;
use App\ProduitMagazin;
use Session;
use DB;
use Illuminate\Http\Request;

class MouvementController extends Controller
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
            $mouvement = Mouvement::where('type', 'LIKE', "%$keyword%")
                ->orWhere('produit', 'LIKE', "%$keyword%")
                ->orWhere('quantite', 'LIKE', "%$keyword%")
                ->orWhere('magazin', 'LIKE', "%$keyword%")
                ->orWhere('operation', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $mouvement = Mouvement::latest()->paginate($perPage);
        }

        return view('admin.mouvement.index', compact('mouvement'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.mouvement.create');
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
        $good= false;
        $requestData = $request->all();
        $exist=DB::connection(session::get('geststock_database'))->table('geststock_mouvements')->where(['type' => $requestData['type'], 'produit'=> intval($requestData['produit']),'operation'=> intval($requestData['operation']), 'magazin'=> intval($requestData['magazin'])])->get();
        if( sizeof($exist)!=0 ) return redirect()->back()->with('error_message', 'Cette '.$requestData['type'].' a déjà été efectuée pour cette opération dans ce magazin !!');
        if( $requestData['quantite']<=0 ) return redirect()->back()->with('error_message', 'La quantitée doit être supérieure à 0 !');
       
        //update stocks
        
        if( $requestData['type']=='Entree de stock' ){
            //dd($requestData['type']);
            $exist=DB::connection(session::get('geststock_database'))->table('geststock_produit_magazins')->where(['produit' => intval($requestData['produit']), 'magazin'=> intval($requestData['magazin']) ])->get();
            if ( sizeof($exist)==0){
                DB::connection(session::get('geststock_database'))->table('geststock_produit_magazins')
                    ->insert(['produit' => intval($requestData['produit']), 'magazin'=> intval($requestData['magazin']), 'stock'=> intval($requestData['quantite']) ]);

            }
            else{
                DB::connection(session::get('geststock_database'))->table('geststock_produit_magazins')
                ->where(['produit' => intval($requestData['produit']), 'magazin'=> intval($requestData['magazin']) ])
                ->increment('stock', intval($requestData['quantite']) );
            }
            
            DB::connection(session::get('geststock_database'))->table('geststock_produits')
            ->where(['id' => intval($requestData['produit']) ])
            ->increment('stock', intval($requestData['quantite']));
            $good=true;
        }
        else{
            $last_stock_in_magazin=ProduitMagazin::where(['produit'=>intval($requestData['produit']),'magazin'=>intval($requestData['magazin']) ])->value('stock');
            if( $last_stock_in_magazin <  intval($requestData['quantite']) ){
                return redirect()->back()->with('error_message', 'Stock insuffisant!');
            }
            $exist=DB::connection(session::get('geststock_database'))->table('geststock_produit_magazins')->where(['produit' => intval($requestData['produit']), 'magazin'=> intval($requestData['magazin']) ])->get();
            if ( sizeof($exist)==0){
                return redirect()->back()->with('error_message', 'Stock insuffisant !');
            }
            else{
                DB::connection(session::get('geststock_database'))->table('geststock_produit_magazins')
                ->where(['produit' => intval($requestData['produit']), 'magazin'=> intval($requestData['magazin']) ])
                ->decrement('stock', intval($requestData['quantite']) );
            }
            
            DB::connection(session::get('geststock_database'))->table('geststock_produits')
            ->where(['id' => intval($requestData['produit']) ])
            ->decrement('stock', intval($requestData['quantite']));
            $good=true;
        }
        if($good){
            DB::connection(session::get('geststock_database'))->table('geststock_mouvements')->insert(['type' => $requestData['type'], 'produit'=> intval($requestData['produit']), 'quantite'=> intval($requestData['quantite']), 'magazin'=> intval($requestData['magazin']), 'operation'=> intval($requestData['operation']), 'description'=>$requestData['description'] ]);
        }
        return redirect()->back()->with('flash_message', 'Mouvement effectué!');
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
        $mouvement = Mouvement::findOrFail($id);

        return view('admin.mouvement.show', compact('mouvement'));
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
        $mouvement = Mouvement::findOrFail($id);
        $produits= Produit::all();
        $magazins= Magazin::all();
        $types= ['Entree de stock'=>'Entree de stock', 'Sortie de stock'=>'Sortie de stock'];
        return view('admin.mouvement.edit', compact('mouvement'))->with(['types'=>$types, 'produits'=>$produits, 'magazins'=>$magazins, 'operation'=> $mouvement->operation]); 
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
        
        $mouvement = Mouvement::findOrFail($id);
        $mouvement->update($requestData);

        return redirect()->back()->with('flash_message', 'Mouvement modifié!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $r, $id)
    {
        //update stocks
        $mouvement = Mouvement::findOrFail($id);

        Mouvement::destroy($id);
        if( $mouvement->type=='Entree de stock' ){
            DB::connection(session::get('geststock_database'))->table('geststock_produit_magazins')
            ->where(['produit' => $mouvement->produit , 'magazin'=> $mouvement->magazin ])
            ->decrement('stock', $mouvement->quantite );

            DB::connection(session::get('geststock_database'))->table('geststock_produits')
            ->where(['id' => $mouvement->produit  ])
            ->decrement('stock', $mouvement->quantite );
        }
        else{
            DB::connection(session::get('geststock_database'))->table('geststock_produit_magazins')
            ->where(['produit' => $mouvement->produit , 'magazin'=> $mouvement->magazin ])
            ->increment('stock', $mouvement->quantite );

            DB::connection(session::get('geststock_database'))->table('geststock_produits')
            ->where(['id' => $mouvement->produit  ])
            ->increment('stock', $mouvement->quantite );
        }
        return redirect('admin/operation/'.$r->input('operation'))->with('flash_message', 'Mouvement supprimé!');
    }
}
