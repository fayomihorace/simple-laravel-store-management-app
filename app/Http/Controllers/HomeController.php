<?php
namespace App\Http\Controllers;
use DB;
use Session;
use PDF;
use App\Produit;
use App\Operation;
use App\Membre;
use App\Magazin;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        $nb_produits = Produit::all()->count();
        $produits = Produit::all(); 
        $nb_magazins = Magazin::all()->count();
        $nb_operations = Operation::all()->count();
        $nb_membres = Membre::all()->count(); 

        $products_colors = ['rgba(255, 99, 132, 0.2)','rgba(54, 162, 235, 0.2)','rgba(255, 206, 86, 0.2)','rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)','rgba(255, 159, 64, 0.2)'];
        $limit = intval($nb_produits/6 )+1 ; 
        return view('home')->with([ 'nb_produits'=> $nb_produits, 'products_colors'=> $products_colors,  'produits'=> $produits, 'nb_magazins'=> $nb_magazins, 'nb_operations'=> $nb_operations, 'nb_membres'=> $nb_membres, 'limit'=>$limit ]);
    }
}
