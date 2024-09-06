<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class HotelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name.en' => 'required|min:3',
            'name.ar' => 'required|min:3',
            'location.en' => 'required|min:3',
            'location.ar' => 'required|min:3',
            'contact_number' => 'required|min:10|numeric',
            'company_id' => 'required|numeric'
        ];
    }
}
