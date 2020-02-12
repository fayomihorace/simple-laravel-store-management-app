<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Magazin;
use Illuminate\Http\Request;

class MagazinController extends Controller
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
            $magazin = Magazin::where('nom', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $magazin = Magazin::latest()->paginate($perPage);
        }

        return view('admin.magazin.index', compact('magazin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.magazin.create');
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
      
        if(!Magazin::where( ['nom'=>  $requestData['nom'] ])->exists()){
            $magazin=Magazin::create($requestData);
            $magazin->update($requestData);
            return redirect('admin/magazin')->with('flash_message', 'magasin ajoutée!');
        }
        return redirect()->back()->with('error_message', 'Un magasin avec le nom <<'.$requestData['nom'].'>> existe déjà !!');  
    
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
        $magazin = Magazin::findOrFail($id);

        return view('admin.magazin.show', compact('magazin'));
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
        $magazin = Magazin::findOrFail($id);

        return view('admin.magazin.edit', compact('magazin'));
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
        
        $magazin = Magazin::findOrFail($id);
        $magazin->update($requestData);

        return redirect('admin/magazin')->with('flash_message', 'Magazin modifié!');
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

        if( Magazin::join("geststock_mouvements", "geststock_mouvements.magazin", "=", "geststock_magazins.id")
            ->where( ['geststock_magazins.id'=>  $id ])->exists()){
            return redirect()->back()->with('error_message', 'Impossible de supprimer ce magasin car au moins un mouvement a été effectué dans ce magasin !!');  
        }
        if( Magazin::join("geststock_ajout_stocks", "geststock_ajout_stocks.magazin", "=", "geststock_magazins.id")
            ->where( ['geststock_magazins.id'=>  $id ])->exists()){
            return redirect()->back()->with('error_message', 'Impossible de supprimer ce magasin car au moins un ajout de stock a été effectué dans ce magasin !!');  
        }
        Magazin::destroy($id);

        return redirect('admin/magazin')->with('flash_message', 'Magasin supprimé!');
    }
}
