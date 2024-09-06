<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OwnerCompany ;
use Hash ;

class OwnerCompanyController extends Controller
{
    public function index()
    {
        $owners = OwnerCompany::latest()->get() ;
        return view('pages.dashboard.owners.index' , compact('owners')) ;
    }

    public function store(Request $request)
    {
        try{
            $validate = $request->validate(['name' => 'required', 'email' => 'required|unique:owner_companies,email' ,'password' => 'required|min:5|max:20' , 'phone' => 'digits:11' ]) ;
            OwnerCompany::create([
                'name' => $request->name ,
                'email' => $request->email ,
                'password' => Hash::make($request->password) ,
                'phone' => $request->phone ,
            ]);
            return redirect()->back()->with(['success' => __(key:'site.added_successfully')]);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        try{
            $validate = $request->validate(['name' => 'required', 'email' => 'required|unique:owner_companies,email,'.$request->id ,'password' => 'required|min:5|max:20' , 'phone' => 'digits:11' ]) ;
            $owner = OwnerCompany::findorfail($request->id) ;
            $owner->update([
                'name' => $request->name ,
                'email' => $request->email ,
                'password' => Hash::make($request->password) ,
                'phone' => $request->phone ,
            ]);
            return redirect()->back()->with(['success' => __(key:'site.updated_successfully')]);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try{
            $owner = OwnerCompany::findorfail($id)->delete() ;
            return redirect()->back()->with(['success' => __(key:'site.deleted_successfully')]);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
