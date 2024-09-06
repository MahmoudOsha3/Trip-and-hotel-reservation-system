<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Trip , Company , Place , Payment} ;
use App\Traits\PaymentTrait;
use App\Mail\ConfirmPaymentTrip ;
use DB  , Mail ;

class TripController extends Controller
{
    use PaymentTrait ;

    public function getAllPlaces()
    {
        $places = Place::all() ;
        return view('pages.website.trips.places.index', compact('places'));
    }

    public function getAllTripsUsingPlace($place_id)
    {
        try
        {
            $place = Place::with(['trips' => function($query){
                $query->where('date_trip' , '>' , now()) ;
            }])->findorfail($place_id) ;
            return view('pages.website.trips.places.trips', compact('place'));
        }
        catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }



    public function getDetailsAboutTrip($trip_id)
    {
        try
        {
            $trip = Trip::findorfail($trip_id);
            if(now()->greaterThanOrEqualTo($trip->date_trip)){
                return redirect()->back() ;
            }
            return view('pages.website.trips.trips.details' , compact('trip'));
        }
        catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    // عرض الرحلات الخاصة بكل شركة
    public function getAllTripsOfCompany($company_id)
    {
        try
        {
            $company = Company::with(['trips' => function($query){
                $query->where('date_trip' , '>' , now() );
            }])->findorfail($company_id);

            return view('pages.website.trips.company.trips' , compact('company')) ;
        }
        catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }


    public function checkout($trip_id)
    {
        try
        {
            $trip = Trip::findorfail($trip_id) ;
            $trip['number_tickets'] = $_GET['quantity'] ;
            $trip['total_price'] = $_GET['quantity'] * $trip['price'] ;
            if( ($trip->booking_seats + $trip->number_tickets) <= $trip->count_seats)
            {
                return view('pages.website.trips.payment.checkout' , compact('trip'));
            }
            return redirect()->back()->with(['error' => __(key:'site.number_tickets_not_enough') ]);
        }
        catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }


    public function payment(Request $request , $trip_id)
    {
        try
        {
            // id of trip , $request , count tickets , total of amount
            DB::beginTransaction();
            $trip = Trip::findorfail($trip_id) ;
            $total_amount = $trip->price * $request->number_tickets ;
            if(($trip->booking_seats + $request->number_tickets) <= $trip->count_seats)
            {
                $charge = $this->paymentStripe($trip , $request , $total_amount);
                if ($charge->status === 'succeeded')
                {
                    $ticket = $this->createTicket($trip->id , auth()->user()->id , $request->number_tickets) ; // 3 => user_id
                    $this->paymentOnSystem($ticket->id , $trip->company->id , $total_amount);
                    $trip->update(['booking_seats' => $trip->booking_seats + $request->number_tickets]);
                    Mail::to('mahmoudabdelrahim189@gmail.com')->send(new ConfirmPaymentTrip($ticket , $request->number_tickets , $total_amount ));
                }
                else
                {
                    throw new \Exception('Payment failed');
                }
                DB::commit();
                return redirect()->route('details.trip' , $trip_id)->with(['success' => 'Payment successful!']);
            }
            return redirect()->back()->with(['error' => __(key:'site.number_tickets_not_enough') ]);
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

}
