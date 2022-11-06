<?php

namespace App\Http\Requests\category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|unique:categories_blog',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A Category Name is required.',
            'name.unique' => 'This Category Name is Already Exist.'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Category Name',
        ];
    }
}
