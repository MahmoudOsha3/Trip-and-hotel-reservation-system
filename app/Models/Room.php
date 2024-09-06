<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Room extends Model
{
    use HasFactory , HasTranslations ;
    const ROOM_TYPES = ['single', 'double', 'suite'];

    public $translatable = ['description' , 'sub_description'] ;
    protected $fillable = ['room_number','room_type', 'description' , 'sub_description' ,'price','availability_status','hotel_id'] ;

    public function images()
    {
        return $this->morphMany(Attachment::class, 'imageable');
    }

    // get the hotel that owns the room
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id') ;
    }

    // get all booking of room
    public function bookings()
    {
        return $this->hasMany(BookingHotel::class , 'room_id') ;
    }
}
