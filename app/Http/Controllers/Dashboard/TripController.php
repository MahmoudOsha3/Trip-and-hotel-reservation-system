<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Trip , Place , Company } ;
use App\Traits\ManageFilesTrait ;
use App\Http\Requests\Admin\TripRequest ;

class TripController extends Controller
{
    use ManageFilesTrait ;

    public function index()
    {
        $trips = Trip::latest()->get() ;
        return view('pages.dashboard.trips.index' , compact('trips')) ;
    }

    public function create()
    {
        $places_trips = Place::all();
        $companies = Company::all() ;
        return view('pages.dashboard.trips.create' , compact('places_trips' , 'companies')) ;
    }

    public function store(TripRequest $request)
    {
        try
        {
            $validate = $request->validated() ;
            $trip = Trip::create([
                'title' => ['en' => $request->title_en , 'ar' => $request->title_ar ] ,
                'sub_description' => ['en' => $request->sub_description_en , 'ar' => $request->sub_description_ar ],
                'description' => ['en' => $request->description_en, 'ar' => $request->description_ar] ,
                'date_trip' => $request->date_trip,
                'price' => $request->price ,
                'count_seats' => $request->count_seats ,
                'place_trip_id' => $request->place_trip_id ,
                'company_id' => $request->company_id
            ]);
            $this->updateOrCreateFiles($request , $trip->id , $model = 'App\Models\Trip' , $folder = 'trips' , $disk = 'trips') ;
            return redirect()->back()->with(['success' => __('site.added_successfully')]);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    // Details of trips
    public function show($trip_id)
    {
        try
        {
            $trip = Trip::findorfail($trip_id);
            return view('pages.dashboard.trips.details' , compact('trip'));
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
            $trip = Trip::findorfail($id);
            $this->deleteAllFiles($trip->id, $model = 'App\Models\Trip' , $folder = 'trips' , $disk = 'trips');
            $trip->delete();
            return redirect()->back()->with(['success' => __('site.added_successfully')]);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
