<?php
namespace App\Http\Controllers;
use DB;
use Session;
use PDF;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function login(Request $request)
    {
      $id = $request->input('id');
      $password = crypt($request->input('password'),'st');
      $user = DB::connection('users')->table('users')
              ->join('universite', ['universite.id'=> 'users.universite'] )
              ->where(['username'=> $id, 'password'=> $password])->get();
      
      if( sizeof($user) ==0 ){
        $message = "Erreur d'identifiant ou de mot de passe";
        return redirect()->back()->with('error', $message);
      }
      session::put('geststock_database', $user[0]->databaseName );
      $user_type = '';
      $type_user=$user[0]->type_user;
      if( $type_user==12 ) $user_type = 'respo';
      else if( $type_user==10 ) $user_type = 'prof';
      else if( $type_user==11 ) $user_type = 'cd';
      else if( $type_user==13 ) $user_type = 'etudiant';
      else if( $type_user==14 ) $user_type = 'admin';
      
      session::put('type_'.$user[0]->matricule, $user_type );
      session::put('utilisateur', $user);
      session::put('token_'.$user[0]->matricule, $request->input('_token'));
      //DB::connection(session::get('geststock_database'))->table('geststock_action')->insert(['name' => 'Connexion', 'user' => $user[0]->username.' '.$user[0]->email, 'matricule'=>$user[0]->matricule, 'annee_acad'=> app('App\Http\Controllers\AuthController')->current_annee_acad()]);

      /*if ($user_type== 'admin') $view = app('App\Http\Controllers\admin\ParametreController')->departlist($request, $user);
      else $view= redirect()->route('user/textbook/init')->with( ['user' => $user, 'user_type'=>$user_type, 'token'=>$request->input('_token')]);
      return $view;*/
      
      return redirect()->route('home');  
    }

      public function logout(Request $request){ 
        session::put('code_'.$request->mat, '');
        session::put('token_'.$request->mat, '');
        session::put('type_'.$request->mat, '');
        session::put('utilisateur', '');
        session::put('geststock_database', '');
        session::put('database_is_selected', false);
        return redirect()->route('login');  
    }
}
