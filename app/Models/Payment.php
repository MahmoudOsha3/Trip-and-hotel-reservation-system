<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id' , 'ticket_trips_id' , 'booking_hotel_id' ,'company_id','amount' , 'currency' , 'date_payment' ] ;



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    // لجلب عدد التذاكر المدفوعة
    public function ticket()
    {
        return $this->belongsTo(TicketTrip::class, 'ticket_trips_id');
    }

    // لجلب المدفوعات الخاصة بالحجوزات للفنادق
    public function booking()
    {
        return $this->belongsTo(BookingHotel::class, 'booking_hotel_id');
    }


}
