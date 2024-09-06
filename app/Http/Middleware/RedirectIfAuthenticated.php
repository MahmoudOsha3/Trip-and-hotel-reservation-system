<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard('admin')->check())
        {
            return redirect(RouteServiceProvider::ADMIN) ;
        }

        if(Auth::guard('owner_company')->check())
        {
            return redirect(RouteServiceProvider::OWNER) ;
        }

        if(Auth::guard('web')->check())
        {
            return redirect(RouteServiceProvider::USER);
        }

        return $next($request);
    }
}
