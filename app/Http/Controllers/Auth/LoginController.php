<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash , Auth };
use App\Traits\AuthTrait ;

class LoginController extends Controller
{
    use AuthTrait ;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // view login
    public function create($type)
    {
        return view('auth.login' , compact('type'));
    }


    public function checklogin(Request $request)
    {
        if(Auth::guard($this->checkGuard($request))->attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return $this->redirectTo($request);
        }
        return redirect()->back()->withErrors(['email' => __(key:'auth.failed')])->withInput() ;
    }

    public function logout(Request $request ,$type)
    {
        Auth::guard($type)->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        if(Auth::guard('web')){
            return redirect()->route('home') ;
        }
        return redirect()->route('welcome');
    }
}
