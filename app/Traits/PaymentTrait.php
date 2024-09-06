<?php

namespace App\Traits ;
use Stripe ;
use App\Models\{TicketTrip , Payment , BookingHotel } ;

trait PaymentTrait
{

    // ================ Trips ====================
    public function paymentStripe($trip , $request , $total_amount )
    {
        Stripe\Stripe::setApiKey(config('services.stripe.secret_key'));

        $charge = Stripe\Charge::create ([
            "amount" => $total_amount *  100 , // 1000 => 10 pound
            "currency" => 'egp',
            "source" => $request->stripeToken,
            "description" => "payment proccess for trip to $trip->title ",
            "metadata" => [
                "trip_id" => $trip->id ,
            ],
        ]);
        return $charge ;
    }

    public function createTicket($trip_id , $user_id , $number_tickets)
    {
        // first create seat number
        $last_seat_number = TicketTrip::where('trip_id' , $trip_id)->latest()->first('seat_number');
        $seat_number_ticket = $last_seat_number == null ?  1 : $last_seat_number->seat_number + 1 ;
        // craete tickets
        for ($i = 1 ; $i <= $number_tickets ; $i++)
        {
            $ticket = TicketTrip::create([
                'user_id' => $user_id ,
                'trip_id' => $trip_id,
                'seat_number' => $seat_number_ticket ,
                'payment_status' => 'paid',
                'booking_date' => now(),
            ]);
            $seat_number_ticket ++ ;
        }
        return $ticket ;
    }


    public function paymentOnSystem($ticket_id , $company_id , $total_amount)
    {
        Payment::create([
            'user_id' => auth()->user()->id ,
            'ticket_trips_id' => $ticket_id ,
            'company_id' => $company_id,
            'amount' => $total_amount ,
            'currency' => 'egp',
            'date_payment' => now() ,
        ]);
    }



    // ======================== Hotel =====================
    public function paymentStripeRoom( $room , $total_price , $request)
    {
        Stripe\Stripe::setApiKey(config('services.stripe.secret_key'));
        $charge = Stripe\Charge::create ([
            "amount" => $total_price * 100 , // 1000 => 10 pound
            "currency" => 'egp',
            "source" => $request->stripeToken ,
            "description" => "payment proccess for room number : $room->room_number , " .$room->hotel->company->title ,
            "metadata" => [
                "room_id" => $room->id ,
            ],
        ]);
    }

    public function createBookingInHotel($room , $request)
    {
        BookingHotel::create([
            'user_id' => auth()->user()->id ,
            'company_id' => $room->hotel->company->id ,
            'room_id' => $room->id ,
            'from_date' => $request->from_date ,
            'to_date' => $request->to_date ,
            'booking_date'=> now() ,
            'payment_status' => 'paid'
        ]) ;
    }

    public function paymentOnSystemToHotel($room , $total_price)
    {
        Payment::create([
            'user_id' => auth()->user()->id ,
            'booking_hotel_id' => $room->hotel->id,
            'company_id' => $room->hotel->company->id ,
            'amount' => $total_price,
            'currency' => 'egp',
            'date_payment' => now() ,
        ]);
    }
}


