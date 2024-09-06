<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Place ;
use Storage ;

class PlaceController extends Controller
{

    public function index()
    {
        $places = Place::all() ;
        return view('pages.dashboard.places.index' , compact('places')) ;
    }

    public function store(Request $request)
    {
        try{
            $validate = $request->validate(['name_en' => 'required|min:3' , 'name_ar' => 'required|min:3' ]);
            $path_file = 'default.png' ;
            if($request->hasFile('file'))
            {
                $path_file = $request->file->getClientOriginalName() ;
                $request->file->storeAs('files/places', $path_file , $disk = 'trips') ;
            }
            Place::create([
                'name' => [
                    'ar' => $request->name_ar ,
                    'en' => $request->name_en
                ] ,
                'filename' => $path_file ,
            ]);
            return redirect()->back()->with(['success' => __(key:'site.added_successfully')]) ;
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]) ;
        }

    }


    public function update(Request $request, $id)
    {
        try{
            $validate = $request->validate(['name_en' => 'required|min:3' , 'name_ar' => 'required|min:3' ]);
            $place = Place::findorfail($request->id);
            $path_file = 'default.png' ;
            if($request->hasFile('file'))
            {
                $path_file = $request->file->getClientOriginalName() ;
                $request->file->storeAs('files/places', $path_file , $disk = 'trips') ;
            }
            $place->update([
                'name' => [
                    'ar' => $request->name_ar ,
                    'en' => $request->name_en
                ],
                'filename' => $path_file ,
            ]);
            return redirect()->back()->with(['success' => __(key:'site.updated_successfully')]) ;
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]) ;
        }
    }

    public function destroy(Request $request , $id)
    {
        try{
            $place = Place::findorfail($request->id);
            if(Storage::disk('trips')->exists('files/places/'. $place->filename))
            {
                Storage::disk('trips')->delete('files/places/'. $place->filename);
            }
            $place->delete() ;
            return redirect()->back()->with(['success' => __(key:'site.deleted_successfully')]) ;
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]) ;
        }
    }
}
