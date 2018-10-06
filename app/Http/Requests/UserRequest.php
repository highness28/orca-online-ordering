<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::check()) {
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
            'email' => 'required',
            'password' => 'required',
            'first_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'middle_name' => 'nullable|regex:/^[\pL\s\-]+$/u',
            'last_name' => 'nullable|regex:/^[\pL\s\-]+$/u',
            'mobile_number' => 'nullable|regex:/^[0-9]+$/u',
            'image' => 'nullable|image'
        ];
    }
}
