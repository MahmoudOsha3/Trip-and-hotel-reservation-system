<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TripRequest extends FormRequest
{
    public function authorize()
    {
        return true ;
    }

    public function rules()
    {
        return [
            'title_en' => 'required|min:3' ,
            'title_ar' => 'required|min:3' ,
            'sub_description_en' => 'required|min:4',
            'sub_description_ar' => 'required|min:4',
            'description_en' => 'required|min:10',
            'description_ar' => 'required|min:10',
            'date_trip' => 'required|date' ,
            'price' => 'required|numeric|min:2',
            'count_seats' => 'required|numeric',
            'place_trip_id' => 'required|numeric' ,
            'company_id' => 'required|numeric',
            'files' => 'required'
        ];
    }
}
