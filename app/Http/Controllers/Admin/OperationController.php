<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Operation;
use App\Membre;
use App\Produit;
use App\Magazin;
use App\Responsable;
use App\Mouvement;
use DB;
use Session;
use Illuminate\Http\Request;

class OperationController extends Controller
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
            $operation = Operation::join("geststock_membres", "geststock_membres.id", "=", "geststock_operations.membre")
            ->join("geststock_responsables", "geststock_responsables.id", "=", "geststock_operations.responsable")
            ->select("geststock_operations.id", "geststock_operations.end", 'geststock_responsables.nom as responsable', 'geststock_membres.nom as membre', 'geststock_responsables.prenom as responsable_prenom', 'geststock_membres.prenom as membre_prenom', 'geststock_operations.created_at')
            ->where('reference', 'LIKE', "%$keyword%")
                ->orWhere('membre', 'LIKE', "%$keyword%")
                ->orWhere('responsable', 'LIKE', "%$keyword%")
                ->orderby('geststock_operations.created_at','asc')
                ->paginate($perPage);
        } else {
            $operation = Operation::join("geststock_membres", "geststock_membres.id", "=", "geststock_operations.membre")
            ->join("geststock_responsables", "geststock_responsables.id", "=", "geststock_operations.responsable")
            ->select("geststock_operations.id", "geststock_operations.end", 'geststock_responsables.nom as responsable', 'geststock_membres.nom as membre', 'geststock_responsables.prenom as responsable_prenom', 'geststock_membres.prenom as membre_prenom', 'geststock_operations.created_at')
            ->orderby('geststock_operations.created_at','asc')
            ->paginate($perPage);
        }
        $membres = Membre::all();
        $responsables = Responsable::all();
        
        return view('admin.operation.index', compact('operation'))->with(['membres'=> $membres, 'responsables'=> $responsables]) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $membres = Membre::all();
        $responsables = Responsable::all();
        $nombre_operation_non_terminees = Operation::where(['end'=>'no'])->get()->count(); 
        if( $nombre_operation_non_terminees!=0 ) return redirect()->back()->with('error_message', 'Vous avez une oprération encours non terminée ! Veulliez la terminer avant de commencer une autre !');
        
        return view('admin.operation.create')->with(['membres'=> $membres, 'responsables'=> $responsables]) ;
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
        $nombre_operation_non_terminees = Operation::where(['end'=>'no'])->get()->count(); 
        if( $nombre_operation_non_terminees!=0 ) return redirect()->back()->with('error_message', 'Vous devez terminer votre oprération en cours avant de commencer une autre !');

        $requestData = $request->all();
        DB::connection(session::get('geststock_database'))->table('geststock_operations')->insert(['membre' => $requestData['membre'], 'responsable' => $requestData['responsable'] ]);
    
        return redirect('admin/operation')->with('flash_message', 'Operation ajoutée!');
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
        $operation = Operation::join("geststock_membres", "geststock_membres.id", "=", "geststock_operations.membre")
        ->join("geststock_responsables", "geststock_responsables.id", "=", "geststock_operations.responsable")
        ->select("geststock_operations.id", "geststock_operations.end", 'geststock_responsables.nom as responsable', 'geststock_membres.nom as membre', 'geststock_responsables.prenom as responsable_prenom', 'geststock_membres.prenom as membre_prenom')
        ->findOrFail($id);
        /*$mouvements = DB::connection(session::get('geststock_database'))->table('geststock_mouvements')
        ->where(['operation' => $id ])->get();*/
        
        $mouvements = Mouvement::join("geststock_produits", "geststock_produits.id", "=", "geststock_mouvements.produit")
        ->join("geststock_magazins", "geststock_magazins.id", "=", "geststock_mouvements.magazin")
        ->select("geststock_mouvements.type", 'geststock_mouvements.id', "geststock_mouvements.quantite", 'geststock_magazins.nom as magazin', 'geststock_produits.nom as produit')
        ->where(["geststock_mouvements.operation"=> $id])
        ->get();
        $produits= Produit::all();
        $magazins= Magazin::all();
        Session::put('operation_is_end', $operation->end );
        Session::put('operation', $operation );
        $types= ['Sortie de stock'=>'Sortie de stock', 'Entree de stock'=>'Entree de stock'];
        return view('admin.operation.show', compact('operation'))->with(['mouvements'=>$mouvements,'produits'=>$produits, 'magazins'=>$magazins, 'types'=>$types]) ;
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
        $operation = Operation::findOrFail($id);
        $membres = Membre::all();
        $responsables = Responsable::all();
        return view('admin.operation.edit', compact('operation'))->with(['membres'=> $membres, 'responsables'=> $responsables]) ;
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
        
        $operation = Operation::findOrFail($id);
        $operation->update($requestData);

        return redirect('admin/operation')->with('flash_message', 'Operation updated!');
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
        $mouvements= Mouvement::where(['operation'=>$id])->get();
        //dd($mouvements);
        foreach ($mouvements as $mouvement ) {
            app('App\Http\Controllers\Admin\MouvementController')->updateMouvement($mouvement);
        }
        
        Operation::destroy($id);
        return redirect('admin/operation')->with('flash_message', 'Operation supprimée!');
    }

    public function end($id)
    {
        $number_of_mouvements=Mouvement::where(['operation'=>$id])->count();
        
        if($number_of_mouvements==0) return redirect()->back()->with('error_message', 'Vous devez ajouter au moins un mouvement avant de terminer l\'opération !');

        DB::connection(session::get('geststock_database'))->table('geststock_operations')
        ->where(['id' => $id ])
        ->update(['end' => 'yes' ]);
        return redirect()->back()->with('flash_message', 'Opération terminée!');
    }
}
