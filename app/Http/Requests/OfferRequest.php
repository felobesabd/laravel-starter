<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'name_en' => 'required|max:100|unique:offers,name_en',
            'name_ar' => 'required|max:100|unique:offers,name_ar',
            'price' => 'required|numeric',
            'details_en' => 'required',
            'details_ar' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name_en.required' => __('validation.name_req'),
            'name_ar.required' => __('validation.name_req'),
            'name_en.unique' => __('validation.name_unique'),
            'name_ar.unique' => __('validation.name_unique'),
            'price.numeric' => 'the offer price must be number',
            'price.required' => 'offer price is required',
            'details_en.required' => 'offer details is required',
            'details_ar.required' => 'offer details is required',
        ];
    }
}
