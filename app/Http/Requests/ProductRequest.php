<?php

namespace App\Http\Requests;
use Auth;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()->role == 1) {
            return true;
        }
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
            'product_name' => 'required',
            'category' => 'required',
            'brand' => 'required',
            'item_code' => 'required',
            'product_price' => 'required',
            'critical_value' => 'required',
            'description' => 'required',
            'specification' => 'required'
        ];
    }
}
