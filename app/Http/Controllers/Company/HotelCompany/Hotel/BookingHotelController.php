<?php

namespace App\Http\Controllers\Company\HotelCompany\Hotel;

use App\Http\Controllers\Controller;
use App\Models\{BookingHotel , Room };
use Illuminate\Http\Request;
use Carbon\Carbon;


class BookingHotelController extends Controller
{

    // عرض كل الحجوزات الخاصة بالشركة
    public function index()
    {
        $reservations = BookingHotel::where('company_id' , auth()->user()->company->id)->get();
        $this->handleDaysAndTotalPrice($reservations) ;
        return view('pages.company.HotelsCompany.booking.index', compact('reservations'));
    }

    // details of booking
    public function show($id)
    {
        $booking = BookingHotel::findorfail($id) ;
        $booking->days = Carbon::parse($booking->from_date)->diffInDays(Carbon::parse($booking->to_date)) ;
        $booking->total_price = $booking->days * $booking->room->price ;
        return view('pages.company.HotelsCompany.booking.details' , compact('booking')) ;
    }

    public function destroy($id)
    {
        try
        {
            $booking = BookingHotel::findorfail($id) ;
            // انا عايز ان مينفعش يحذف بعد اول يوم من ميعاد الاقامة بدا او لو حصل عملية دفع الحالة الوحيدة اللي يقدر يحذف فيها هي قبل الاقامة في الفندق بس
            if(now()->greaterThanOrEqualTo($booking->from_date) || $booking->payment_status == 'paid')
            {
                return redirect()->back()->with(['error' => __(key:'dashboard.no_delete_booking')]);
            }
            else
            {
                Room::where('id' , $booking->room->id )->update(['availability_status' =>  0]);  // اصبحت متاحة للحجز
                $booking->delete();
                return redirect()->back()->with(['success' => __(key:'site.deleted_successfully')]);
            }
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]) ;
        }
    }

    public function handleDaysAndTotalPrice($reservations)
    {
        foreach ($reservations as $booking){
            $booking->days = Carbon::parse($booking->from_date)->diffInDays(Carbon::parse($booking->to_date)) ;
            $booking->total_price = $booking->days * $booking->room->price ;
        }
    }
}
