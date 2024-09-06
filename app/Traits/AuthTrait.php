<?php

namespace App\Traits ;

use Auth ;

trait AuthTrait
{
    public function checkGuard($request)
    {
        if($request->type == 'admin')
        {
            return 'admin' ;
        }
        elseif ($request->type == 'owner')
        {
            return 'owner_company' ;
        }
        elseif($request->type == 'user')
        {
            return 'web' ;
        }
    }


    public function redirectTo($request)
    {
        if($request->type == 'admin')
        {
            return redirect()->route('admin.dashboard') ;
        }
        elseif ($request->type == 'owner')
        {
            return redirect()->route('owner.dashboard') ;
        }
        elseif($request->type == 'user')
        {
            return redirect()->route('home');
        }
    }



}
