<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \Illuminate\Http\Request;
/* use Illuminate\Support\Facades\Auth; */

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /* PARA AUTENTICAR CON UN VALOR AGREGADO EN LA DB (agregando la dependencia de request) */
    protected function authenticated(Request $request, $user)
    {
        if($user->admin < 1) {
            return redirect()->intended('/'); // it will be according to your routes.

        } else {
            return redirect()->intended('/home'); // it also be according to your need and routes
        }
    }
    public function logout () {        
        auth()->logout();        
        return redirect('/');
    }
}
