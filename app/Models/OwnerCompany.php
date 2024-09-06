<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class OwnerCompany extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = ['name' , 'email' , 'password' , 'phone'] ;


    // الاونر ممكن يبقي لي اكتر من شركة
    public function company()
    {
        return $this->hasOne(Company::class, 'owner_id');
    }

}
