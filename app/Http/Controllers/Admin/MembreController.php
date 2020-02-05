<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Membre;
use Illuminate\Http\Request;

class MembreController extends Controller
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
            $membre = Membre::where('nom', 'LIKE', "%$keyword%")
                ->orWhere('prenom', 'LIKE', "%$keyword%")
                ->orWhere('adresse', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('telephone', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $membre = Membre::latest()->paginate($perPage);
        }

        return view('admin.membre.index', compact('membre'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.membre.create');
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
        
        $membre=Membre::create($requestData);
        $membre->update($requestData);
        return redirect('admin/membre')->with('flash_message', 'Membre ajouté!');
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
        $membre = Membre::findOrFail($id);

        return view('admin.membre.show', compact('membre'));
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
        $membre = Membre::findOrFail($id);

        return view('admin.membre.edit', compact('membre'));
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
        
        $membre = Membre::findOrFail($id);
        $membre->update($requestData);

        return redirect('admin/membre')->with('flash_message', 'Membre updated!');
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

        if( Membre::join("geststock_operations", "geststock_operations.membre", "=", "geststock_membres.id")
            ->where( ['geststock_membres.id'=>  $id ])->exists()){
            return redirect()->back()->with('error_message', 'Impossible de supprimer ce membre car au moins une opération a été effectuée avec ce membre !!');  
        }
        
        Membre::destroy($id);

        return redirect('admin/membre')->with('flash_message', 'Membre supprimé!');
    }
}
