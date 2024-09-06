<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class TripRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'title.en' => 'required|min:3',
            'title.ar' => 'required|min:3',
            'sub_description.en' => 'required|min:4',
            'sub_description.ar' => 'required|min:4',
            'description.en' => 'required|min:10',
            'description.ar' => 'required|min:10',
            'date_trip' => 'required|date',
            'price' => 'required|numeric|min:2',
            'count_seats' => 'required|numeric',
            'place_trip_id' => 'required|numeric',
            'company_id' => 'required|numeric',
        ];

        // في حالة تخزين
        if ($this->isMethod('post')) {
            $rules['files'] = 'required';
        }

        return $rules;
    }
}
