<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => 'required|string|max:60|regex:/^[a-zA-Z].*/',
            'phone'=>'required|numeric|min:10',
            'email'=>'email|required|max:121',
            'address'=>'required|string|max:600',
            'pin_code'=>'required|max:6|min:6',
            'location_type'=>'required',
            'delivery_date'=>'required|date|after:today|before:14 days',
            'prefer_delivery_time'=>'required',
            'language'=>'required',
            'mobile_country_code'=>'required',
            'currency_iso_code'=>'required',
            'delivery_instructions'=>'nullable'
        ];
    }
}
