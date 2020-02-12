<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
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
            $fournisseur = Fournisseur::where('nom', 'LIKE', "%$keyword%")
                ->orWhere('adresse', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('telephone', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $fournisseur = Fournisseur::latest()->paginate($perPage);
        }

        return view('admin.fournisseur.index', compact('fournisseur'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.fournisseur.create');
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
        
        $fournisseur = Fournisseur::create($requestData);
        $fournisseur->update($requestData);
        return redirect('admin/fournisseur')->with('flash_message', 'Fournisseur ajouté!');
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
        $fournisseur = Fournisseur::findOrFail($id);

        return view('admin.fournisseur.show', compact('fournisseur'));
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
        $fournisseur = Fournisseur::findOrFail($id);

        return view('admin.fournisseur.edit', compact('fournisseur'));
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
        
        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->update($requestData);

        return redirect('admin/fournisseur')->with('flash_message', 'Fournisseur modifié!');
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

        if( Fournisseur::join("geststock_ajout_stocks", "geststock_ajout_stocks.fournisseur", "=", "geststock_fournisseurs.id")
            ->where( ['geststock_fournisseurs.id'=>  $id ])->exists()){
            return redirect()->back()->with('error_message', 'Impossible de supprimer ce fournisseur car au moins un ajout de stock a été effectué avec fournisseur !!');  
        }
        
        Fournisseur::destroy($id);

        return redirect('admin/fournisseur')->with('flash_message', 'Fournisseur supprimé!');
    }
}
