<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'room_number' => 'required|numeric',
            'room_type' => 'required' ,
            'sub_description.ar' => 'required|max:255',
            'sub_description.en' => 'required|max:255',
            'description.ar' => 'required' ,
            'description.en' => 'required' ,
            'price' => 'required' ,
            'hotel_id' => 'required',
            'files' => 'required'
        ];
    }
}
