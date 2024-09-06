<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\{Room , Hotel };
use Illuminate\Http\Request;

class RoomController extends Controller
{

    public function index()
    {
        $rooms = Room::latest()->get();
        $hotels = Hotel::all() ;
        return view('pages.dashboard.rooms.index' , compact('rooms' , 'hotels')) ;
    }


    public function store(Request $request)
    {
        try
        {
            Room::create([
                'room_number' => $request->room_number ,
                'room_type' => $request->room_type,
                'description' => ['en' => $request->description_en , 'ar' => $request->description_ar ],
                'price' => $request->price ,
                'hotel_id' => $request->hotel_id
            ]);
            return redirect()->back()->with(['success' => __(key:'site.added_successfully')]) ;
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function show(Room $room)
    {
        //
    }


    public function destroy($id)
    {
        try
        {
            $room = Room::findorfail($id)->delete() ;
            return redirect()->back()->with(['success' => __('site.deleted_successfully')]);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
