<?php

namespace App\Http\Middleware;
use DB;
use Session;
use Closure;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request_token = $request->session()->token();
        $user = session::get('utilisateur');

        if( $user!='' && sizeof($user)!=0 ){
            $user = $user[0];
            $session_token = session::get('token_'.$user->matricule);
            if ( $session_token == $request_token ) return $next($request);
        }
        //die("***$request_token ***                    ###$session_token###");
        return  redirect('login');
    }
}