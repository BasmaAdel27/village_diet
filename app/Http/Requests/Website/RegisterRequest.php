<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'first_name' => 'required|max:255|min:5|string',
            'last_name' => 'required|max:255|min:5|string',
            'email' => 'required|email|confirmed|unique:users,email',
            'phone' => 'required|numeric|unique:users,phone',
            'date_of_birth' => 'required|date|date_format:Y-m-d|before:today',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'address' => 'required|string|max:255',
            'insta_link' => 'required|string',
            'is_postal' => 'nullable|in:1,0',
        ];
    }
}
