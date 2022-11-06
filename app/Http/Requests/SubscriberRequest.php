<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriberRequest extends FormRequest
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
            'subscriber_email' => 'required|unique:subscribers',
        ];
    }

    public function messages()
    {
        return [
            'subscriber_email.unique' => 'This Email has already been subscribed.'
        ];
    }

    public function attributes()
    {
        return [
            'subscriber_email' => 'Email',
        ];
    }
}
