<?php

namespace App\Http\Requests\course;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
            'image' => 'required',
            'category_id' => 'required',
            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Course Name is required.',
            'price.required' => 'price is required.',
            'image.required' => 'image is required.',
            'category_id.required' => 'category is required.',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Course Name',
            'price' => 'price',
            'image' => 'image',
            'category_id' => 'category',
        ];
    }
}
