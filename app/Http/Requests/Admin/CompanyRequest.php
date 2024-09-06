<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true ;
    }

    public function rules()
    {
        return [
            'title_en' => 'required' ,
            'title_ar' => 'required' ,
            'address' => 'required' ,
            'contact_number' =>'required|numeric' ,
            'type_company_id' => 'required|numeric' ,
            'owner_company_id' => 'required|numeric' ,
            'about_company_en' => 'required',
            'about_company_ar' => 'required',
        ];
    }
}
