<?php

namespace App\Http\Controllers\Company\HotelCompany\Hotel;

use App\Http\Controllers\Controller;
use App\Models\{Hotel , Company , Payment };
use Illuminate\Http\Request;
use App\Http\Requests\Admin\HotelRequest ;
use App\Traits\QueryTrait ;

class HotelController extends Controller
{
    use QueryTrait ;

    public function index()
    {
        $companies = Company::where(['owner_id' => auth()->user()->id , 'type_company_id' => 1 ])->get() ;
        $hotels = Hotel::whereIn('company_id' , $companies->pluck('id'))->get();
        return view('pages.company.HotelsCompany.hotels.index' , compact('hotels' , 'companies')) ;
    }


    public function create()
    {
        return view('pages.company.HotelsCompany.hotels.create') ;
    }


    public function store(HotelRequest $request)
    {
        try
        {
            $valiadate = $request->validated() ;
            $this->InsertData(new Hotel , $valiadate);
            return redirect()->back()->with(['success' => __('site.added_successfully')]) ;

        } catch (\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function show(Hotel $hotel)
    {
        //
    }

    public function update(HotelRequest $request, Hotel $hotel)
    {
        try
        {
            $valiadate = $request->validated();
            $this->updataData(new Hotel , $hotel->id ,$valiadate);
            return redirect()->back()->with(['success' => __('site.updated_successfully')]) ;

        } catch (\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Hotel $hotel)
    {
        try
        {
            $this->deleteData(new Hotel , $hotel->id);
            return redirect()->back()->with(['success' => __('site.deleted_successfully')]) ;

        } catch (\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function payments()
    {
        try
        {
            $owner = auth()->user() ;
            $companies_id = Company::where(['owner_id' => $owner->id , 'type_company_id' => 1 ])->pluck('id');
            $payments = Payment::whereIn('company_id' , $companies_id)->latest()->get();
            return view('pages.company.HotelsCompany.payments' , compact('payments')) ;
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
