<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Place extends Model
{
    use HasFactory , HasTranslations ;

    public $translatable = ['name'];
    protected $fillable = ['name' , 'filename'] ;


    public function trips()
    {
        return $this->hasMany(Trip::class, 'place_trip_id');
    }
}
