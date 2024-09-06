<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Trip extends Model
{
    use HasFactory , HasTranslations ;

    public $translatable = ['title' ,'sub_description' , 'description' ];
    protected $fillable = ['title' , 'sub_description' ,'description' ,'date_trip','price','count_seats','booking_seats','place_trip_id' , 'company_id' , 'status_booking'] ;

    public function images()
    {
        return $this->morphMany(Attachment::class, 'imageable');
    }


    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    // get all of the tickets for the Trip
    public function tickets()
    {
        return $this->hasMany(TicketTrip::class, 'trip_id');
    }
}
