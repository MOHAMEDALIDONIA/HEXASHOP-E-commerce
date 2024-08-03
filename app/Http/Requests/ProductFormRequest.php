<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
            'category_id'=>[
                'required',
                'integer'
            ],
            'name'=>[
                'required',
                'string'
            ],
            'description'=>[
                'required',
                'string'
            ],
            'selling_price'=>[
                'required',
                'integer'
            ],
            'original_price'=>[
                'required',
                'integer'
            ],
            'discount_price'=>[
                'nullable',
                'integer'
            ],
            'quantity'=>[
                'required',
                'integer'
            ],
            'tranding'=>[
                'nullable',
                
            ],
            'status'=>[
                'nullable',
                
            ],
            'image'=>[
                'nullable',
               
            ]
        ];
    }
}
