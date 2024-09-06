<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash ;

class UserController extends Controller
{

    public function index()
    {
        $users = User::latest()->get() ;
        return view('pages.dashboard.users.index' , compact('users'));
    }

    public function store(Request $request)
    {
        try
        {
            $validate = $request->validate(['name_ar' => 'required' , 'name_en' => 'required' , 'email' => 'required|email|unique:users,email' , 'phone' => 'required' , 'password' => 'required|min:6']) ;
            User::create([
                'name' => ['ar' => $request->name_ar , 'en' => $request->name_en ] ,
                'email' => $request->email ,
                'phone' => $request->phone ,
                'password' => Hash::make($request->password) ,
                'country' => $request->countery
            ]);
            return redirect()->back()->with(['success' , __(key:'site.added_successfully')]);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' , $e->getMessage()]);
        }
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id )
    {
        try
        {
            // $validate = $request->validate(['name' => 'required' , 'email' => 'required|email|unique:users,email,except,'.$request->id , 'password' => 'required|min:6']) ;
            $user = User::findorfail($request->id) ;
            $user->update([
                'name' => ['ar' => $request->name_ar , 'en' => $request->name_en ] ,
                'email' => $request->email ,
                'phone' => $request->phone ,
                'password' => Hash::make($request->password) ,
                'country' => $request->countery
            ]);
            return redirect()->back()->with(['success' , __(key:'site.updated_successfully')]);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' , $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try
        {
            $user = User::findorfail($id)->delete();
            return redirect()->back()->with(['success' , __(key:'site.deleted_successfully')]);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' , $e->getMessage()]);
        }
    }
}
