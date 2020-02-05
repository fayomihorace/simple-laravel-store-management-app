<?php
namespace App\Http\Controllers;
use DB;
use Session;
use PDF;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

class RequestsController extends Controller
{
    public function get_name_by_id(Request $request, $type, $id)
    {
      return $type;
      DB::connection(session::get('geststock_database'))->table('geststock_action')->insert(['name' => 'Connexion', 'user' => $user[0]->username.' '.$user[0]->email, 'matricule'=>$user[0]->matricule, 'annee_acad'=> app('App\Http\Controllers\AuthController')->current_annee_acad()]);

    }
}
