<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCar extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()->admin == true)
            return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'brand' => 'required|regex:/^[a-zA-Z]+$/|max:255',
            'model' => 'required|regex:/^[a-zA-Z0-9^-]+$/|max:255',
            'production-year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')),
            'cost' => 'required|integer|min:0',
            'fuel-consumption' => 'required|numeric|between:0,99.99',
            'engine-capacity' => 'required|integer|min:500|max:10000',
            'engine-power' => 'required|integer|min:0|max:1000',
            'seats' =>  'required|integer|min:0|',
        ];
    }
    public function messages()
    {
        return [
            'production-year.required' => "The production year field is required.",
            'production-year.regex' => "The production year format is invalid.",

            'engine-capacity.required' => "The engine capacity field is required.",
            'engine-capacity.regex' => "The engine capacity format is invalid.",

            'engine-power.required' => "The engine power field is required.",
            'engine-power.regex' => "The engine power format is invalid.",

            'fuel-consumption.required' => 'The fuel consumption field is required.',
            'fuel-consumption.regex' => "The fuel consumption format is invalid.",

        ];
    }
}
