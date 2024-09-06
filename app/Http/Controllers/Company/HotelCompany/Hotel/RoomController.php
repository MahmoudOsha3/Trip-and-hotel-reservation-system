<?php

namespace App\Http\Controllers\Company\HotelCompany\Hotel;

use App\Http\Controllers\Controller;
use App\Models\{Room , Company , Hotel };
use Illuminate\Http\Request;
use App\Http\Requests\Company\RoomRequest ;
use App\Traits\{QueryTrait , ManageFilesTrait} ;

class RoomController extends Controller
{
    use QueryTrait , ManageFilesTrait ;

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(RoomRequest $request)
    {
        try
        {
            $validate = $request->validated() ;
            $room = $this->InsertData(new Room , $validate);
            $this->updateOrCreateFiles($request , $room->id , $model = 'App\Models\Room', $folder ='rooms' , $disk = 'rooms') ;
            return redirect()->back()->with(['success' , __(key:'site.added_successfully')]);
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    // for display all rooms that espcially hotel
    public function show($hotel_id)
    {
        // انا عايز ابعت كل الاوتيلت الخاصة بهذة الشركة
        $hotel = Hotel::where('id' , $hotel_id)->first();
        return view('pages.company.HotelsCompany.rooms.index',compact('hotel')) ;
    }

    public function update(RoomRequest $request, $id )
    {
        try
        {
            $validate = $request->validated() ;
            $this->updataData(new Room , $id , $validate) ;
            $this->updateOrCreateFiles($request , $id , $model = 'App\Models\Room', $folder ='rooms' , $disk = 'rooms') ;
            return redirect()->back()->with(['success' , __(key:'site.updated_successfully')]);
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try
        {
            $this->deleteData(new Room , $id);
            return redirect()->back()->with(['success' , __(key:'site.deleted_successfully')]);
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
