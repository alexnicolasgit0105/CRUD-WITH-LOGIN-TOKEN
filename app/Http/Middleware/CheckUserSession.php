<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;

class CheckUserSession extends Middleware
{

    public function __construct(){
    }

    public function handle($request,$next)
    {

        
        $_DATA_ = explode("/", $request->url());

        if ($request->session()->exists('token_key')) {

            if (empty($_DATA_[4])) {
                return redirect('/Author/list');       
            }
            
            if (!empty($_DATA_[3]) && strtoupper($_DATA_[3]) == 'MAIN' && strtoupper($_DATA_[4]) != 'LOGOUT') {
                return redirect('/Author/list');
            }

            return $next($request);

        } else {

            if (strtoupper($_DATA_[3]) != 'MAIN')
                return redirect('/Main/');
            else 
                return $next($request);

        }

        

    }
}
