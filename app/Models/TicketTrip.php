<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketTrip extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','trip_id','seat_number','payment_status','booking_date'] ;

    // get the user that owns the ticket
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // get the Trip that owns the ticket
    public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id');
    }

}
