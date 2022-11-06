<?php

namespace App\Http\Requests\course;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Course Name is required.',
            'price.required' => 'price is required.',
            'category_id.required' => 'category is required.',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Course Name',
            'price' => 'price',
            'category_id' => 'category',
        ];
    }
}
