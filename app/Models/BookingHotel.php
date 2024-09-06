<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingHotel extends Model
{
    use HasFactory;
    protected $fillable = ['user_id' , 'company_id' , 'room_id' , 'booking_date' ,'from_date' , 'to_date' , 'number_days' ,'payment_status'] ;

    // get the user that owns the booking
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // get the Company that owns the booking
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id') ;
    }

    // get the room that owns the booking
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id') ;
    }
}
