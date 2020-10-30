<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutUserValidation extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "customer.first_name" => 'required',
            'customer.last_name' => 'required',
            'customer.phone_number' => 'required|regex:/(0)[0-9]{9}/',
            'customer.email' => 'required|email',
            'customer.street_number' => 'required|numeric',
            'customer.street_name' => 'required',
            'customer.phone_number' => 'required',
            'customer.city' => 'required',
            'customer.county' => 'required',
            'customer.zip' => 'required|numeric'
        ];
    }
}
