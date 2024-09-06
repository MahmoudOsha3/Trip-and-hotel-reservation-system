<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Company extends Model
{
    use HasFactory , HasTranslations ;

    public $translatable = ['title' , 'about_company'] ;
    protected $fillable = ['title','about_company' ,'address','contact_number','type_company_id' , 'owner_id'] ;


    public function owner()
    {
        return $this->belongsTo(OwnerCompany::class, 'owner_id');
    }

    public function typecompany()
    {
        return $this->belongsTo(TypeCompany::class, 'type_company_id');
    }

    public function trips()
    {
        return $this->hasMany(Trip::class , 'company_id');
    }


    public function hotel()
    {
        return $this->hasMany(Hotel::class, 'id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class , 'company_id');
    }

}
