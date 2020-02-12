<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Responsable;
use Illuminate\Http\Request;

class ResponsableController extends Controller
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
            $responsable = Responsable::where('nom', 'LIKE', "%$keyword%")
                ->orWhere('prenom', 'LIKE', "%$keyword%")
                ->orWhere('adresse', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('telephone', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $responsable = Responsable::latest()->paginate($perPage);
        }

        return view('admin.responsable.index', compact('responsable'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.responsable.create');
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
        
        $responsable=Responsable::create($requestData);
        $responsable->update($requestData);
        return redirect('admin/responsable')->with('flash_message', 'Responsable ajouté!');
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
        $responsable = Responsable::findOrFail($id);

        return view('admin.responsable.show', compact('responsable'));
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
        $responsable = Responsable::findOrFail($id);

        return view('admin.responsable.edit', compact('responsable'));
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
        
        $responsable = Responsable::findOrFail($id);
        $responsable->update($requestData);

        return redirect('admin/responsable')->with('flash_message', 'Responsable modifié!');
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

        if( Responsable::join("geststock_operations", "geststock_operations.membre", "=", "geststock_responsables.id")
            ->where( ['geststock_responsables.id'=>  $id ])->exists()){
            return redirect()->back()->with('error_message', 'Impossible de supprimer ce responsable car au moins une opération a été effectuée avec ce responsable !!');  
        }

        Responsable::destroy($id);

        return redirect('admin/responsable')->with('flash_message', 'Responsable supprimé!');
    }
}
