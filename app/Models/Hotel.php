<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Hotel extends Model
{
    use HasFactory , HasTranslations ;
    public $translatable = ['name' , 'location'] ;
    protected $fillable = ['name' , 'location' , 'contact_number' , 'company_id'];


    // Get the company that owns the Hotel
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }

    // get all room that own by hotel
    public function room()
    {
        return $this->hasMany(Room::class , 'hotel_id') ;
    }

}
