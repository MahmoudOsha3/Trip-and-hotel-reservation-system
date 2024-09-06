<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Hotel , Room , BookingHotel , Payment } ;
use Carbon\Carbon;
use Stripe , DB , Mail ;
use App\Traits\PaymentTrait;
use App\Mail\ConfirmPayment ;


class HotelController extends Controller
{
    use PaymentTrait ;
    // عرض كل الفنادق
    public function getAllHotels()
    {
        $hotels = Hotel::all() ;
        return view('pages.website.hotel.allHotels' , compact('hotels'));
    }

    public function getAllDetailsOfHotel($hotel_id)
    {
        $hotel = Hotel::findorfail($hotel_id);
        return view('pages.website.hotel.detailsHotel' , compact('hotel'));
    }

    public function getAllDetailsOfRoom($room_id)
    {
        $room = Room::with(['bookings' => function($query){
            $query->where('from_date' ,'>=', Carbon::today())
            ->where('from_date', '<=', Carbon::today()->addMonth(2)) ;
        }])->findOrFail($room_id);
        return view('pages.website.hotel.detailsRoom' , compact('room'));
    }

    // check room avaliable or not using ajax
    public function checkAvailabilityRoom(Request $request)
    {
        $room_id = $request->input('room_id');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        $isAvailable = !DB::table('booking_hotels')->where('room_id', $room_id)
            ->where(
                function($query) use ($from_date, $to_date)
                {
                    $query->whereBetween('from_date', [$from_date, $to_date])
                        ->orWhereBetween('to_date', [$from_date, $to_date])
                        ->orWhere(function($query) use ($from_date, $to_date) {
                            $query->where('from_date', '<', $from_date)
                                    ->where('to_date', '>', $to_date);
                        });
                })->exists();

        return response()->json(['isAvailable' => $isAvailable]);
    }

    public function checkValidateDetailsBookingRoom($from_date , $to_date , $room_id )
    {
        $isAvailable = !DB::table('booking_hotels')->where('room_id', $room_id)
        ->where(
            function($query) use ($from_date, $to_date)
            {
                $query->whereBetween('from_date', [$from_date, $to_date])
                    ->orWhereBetween('to_date', [$from_date, $to_date])
                    ->orWhere(function($query) use ($from_date, $to_date) {
                        $query->where('from_date', '<', $from_date)
                                ->where('to_date', '>', $to_date);
                    });
            })->exists();
            return $isAvailable ;
    }


    public function checkout($room_id)
    {
        try{
            $from_date = request()->from_date;
            $to_date = request()->to_date;

            if(! $from_date || ! $to_date){
                return redirect()->back()->withErrors('Please provide both from and to dates.');
            }

            $details_booking_room = Room::findorfail($room_id) ;
            $isAvailable = $this->checkValidateDetailsBookingRoom($from_date , $to_date , $room_id);

            if($isAvailable){
                $details_booking_room['from_date'] = $from_date;
                $details_booking_room['to_date'] = $to_date;
                return view('pages.website.hotel.checkout', compact('details_booking_room'));
            }
            return redirect()->back()->with(['error' => 'Date is not validate to be booking !']) ;
        }
        catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]) ;
        }
    }


    public function payment(Request $request , $room_id)
    {
        try{
            DB::beginTransaction();
            // details room
            $room = Room::findorfail($room_id) ;

            // calculation number of days and total_price
            $number_days = Carbon::parse($request->from_date)->diffInDays(Carbon::parse($request->to_date));
            $total_price = $number_days * $room->price ;

            // payment proccess
            $this->paymentStripeRoom($room ,$total_price ,$request);
            $this->createBookingInHotel($room , $request);
            $this->paymentOnSystemToHotel($room , $total_price) ;
            Mail::to('mahmoudabdelrahim189@gmail.com')->send(new ConfirmPayment($room , $request->from_date , $request->to_date , $total_price));
            DB::commit();
            return redirect()->route('details.room' , $room->id )->with(['success' , 'Payment is Successfully !']);
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


}
