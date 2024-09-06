<?php

namespace App\Http\Controllers\Company\TripsCompany\Trip ;

use App\Http\Controllers\Controller;
use App\Models\{ Trip , Company , Place , Payment };
use Illuminate\Http\Request;
use App\Traits\{QueryTrait , ManageFilesTrait } ;
use App\Http\Requests\Company\TripRequest ;
use Auth ;

class TripController extends Controller
{
    use QueryTrait , ManageFilesTrait ;

    // خلي بالك ان ممكن الشركة الواحدة ليها كذا فرع او بمعني تاني ان كل شخص لديه اكثر من شركة
    public function index()
    {
        $owner = Auth::user() ;
        // id = 2 because i want trips and must be type company is tourism company
        $companies_id = Company::where(['owner_id' => $owner->id , 'type_company_id' => 2 ])->pluck('id');
        $trips = Trip::whereIn('company_id' , $companies_id )->latest()->get();
        return view('pages.company.tripsCompany.trips.index' , compact('trips'));
    }

    public function create()
    {
        $owner = Auth::user() ;
        $places_trips = Place::all() ;
        $companies = Company::where(['owner_id' => $owner->id , 'type_company_id' => 2 ])->get();
        return view('pages.company.tripsCompany.trips.create' , compact('places_trips' , 'companies')) ;
    }

    public function store(TripRequest $request)
    {
        try
        {
            $validate = $request->validated();
            $trip = $this->InsertData(new Trip, $validate);
            $this->updateOrCreateFiles($request , $trip->id , $model = 'App\Models\Trip' , $folder = 'trips'  ,$disk = 'trips') ;
            return redirect()->back()->with(['success' , __(key:'site.added_successfully')]) ;
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]) ;
        }
    }


    // tickets => show users that booking this trip
    public function show(Trip $trip)
    {
        if($trip->company->owner_id == auth()->user()->id)
        {
            return view('pages.company.tripsCompany.trips.tickets' , compact('trip'));
        }else{
            return redirect()->route('trip.index')->with(['error' => __(key:'dashboard.error_inId')]);
        }
    }

    public function edit($id)
    {
        $owner = Auth::user() ;
        $trip = Trip::findorfail($id) ;
        if($owner->id == $trip->company->owner_id)
        {
            $places_trips = Place::all() ;
            $companies = Company::where(['owner_id' => $owner->id , 'type_company_id' => 2 ])->get();
            return view('pages.company.tripsCompany.trips.edit' , compact('places_trips' , 'companies' , 'trip')) ;
        }
        else
        {
            return redirect()->route('trip.index')->with(['error' , __(key:'dashboard.error_inId')]);
        }
    }

    public function update(TripRequest $request , $id)
    {
        try
        {
            $owner = auth()->user() ;
            $trip = Trip::findorfail($id) ;
            if($owner->id == $trip->company->owner_id)
            {
                $validate = $request->validated();
                $this->updataData(new Trip , $id , $validate);
                $this->updateOrCreateFiles($request , $id , $model = 'App\Models\Trip' , $folder = 'trips'  ,$disk = 'trips') ;
                return redirect()->route('trip.index')->with(['success' , __(key:'site.updated_successfully')]);
            }
            else
            {
                return redirect()->route('trip.index')->with(['error' , __(key:'dashboard.error_inId')]);
            }

        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try
        {
            $owner = auth()->user() ;
            if($owner->id == $trip->company->owner_id)
            {
                $this->deleteData(new Trip, $id);
                $this->deleteAllFiles($id , $model = 'App\Models\Trip' , $folder = 'trips' , $disk = 'trips') ;
                return redirect()->back()->with(['success' => __(key:'site.deleted_successfully')]);
            }
            else
            {
                return redirect()->back()->with(['error' => __(key:'dashboard.error_inId')]);
            }
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function payments()
    {
        try
        {
            $owner = auth()->user() ;
            // $trips = Trip::all() ;
            $companies_id = Company::where(['owner_id' => $owner->id , 'type_company_id' => 2 ])->pluck('id');
            $payments = Payment::whereIn('company_id' , $companies_id)->latest()->get();
            return view('pages.company.tripsCompany.trips.payments' , compact('payments')) ;
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    // toggle between availavle and close booking
    public function toggleStatusBooking($trip_id)
    {
        try
        {
            $trip = Trip::findorfail($trip_id) ;
            // لو الميعاد انتهي لازم الحجز يكون مفلق و ميقدرش يعدل علي حالة الحجز
            if (now()->greaterThanOrEqualTo($trip->date_trip))
            {
                $trip->update(['status_booking' => 'close_booking']);
                return redirect()->back()->with(['error' => __(key:'dashboard.expired_appointment_trip')]);
            }
            else{
                if($trip->status_booking == 'available_booking')
                {
                    $trip->update(['status_booking' => 'close_booking']);
                }
                else
                {
                    $trip->update(['status_booking' => 'available_booking']);
                }
                return redirect()->back()->with(['success' => __(key:'site.updated_successfully')]);
            }
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }



}
