<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeProduct extends FormRequest
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
            'title' => 'required|max:255',
            'slug' => 'required|unique:products',
            'discription' => 'required',
            'thumbnail'=> 'required|mimes:jpeg,bmp,png|max:2048',
            'status' => 'required|numeric',
            'category_id' => 'required',
            'price' => 'required|numeric'
        ];
    }
}
