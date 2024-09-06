<?php

namespace App\Http\Controllers\Dashboard ;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Hotel , Company } ;
use App\Http\Requests\Admin\HotelRequest ;
use App\Traits\QueryTrait ;
class HotelController extends Controller
{

    use QueryTrait ;

    public function index()
    {
        $hotels = Hotel::latest()->get() ;
        $companies = Company::where('type_company_id' , 1 )->get();
        return view('pages.dashboard.hotels.index' , compact('hotels' , 'companies')) ;
    }

    public function store(HotelRequest $request)
    {
        try
        {
            $validate = $request->validated();
            $this->InsertData(new Hotel , $validate) ;
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

    public function update(HotelRequest $request, $id)
    {
        try
        {
            $validate = $request->validated();
            $hotel = Hotel::findorfail($id);
            $hotel->update($validate);
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
            Hotel::findorfail($id)->delete();
            return redirect()->back()->with(['success' , __(key:'site.deleted_successfully')]);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' , $e->getMessage()]);
        }
    }
}
