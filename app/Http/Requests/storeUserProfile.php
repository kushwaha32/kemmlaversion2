<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeUserProfile extends FormRequest
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
            'name' => 'required|max:255',
            'slug' => 'max:255',
            'email' => 'email|unique:users',
            'address' => 'required|max:255',
            'contact_no' => 'required|regex:/^[0-9]{10}$/',
            'password' => 'required|min:8',
            're_type_password' => 'required|same:password',
            'thumbnail' => 'mimes:jpeg,bmp,png|max:2048',

        ];
    }
}
