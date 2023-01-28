<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
              'first_name' => 'required|max:255|min:2|string',
              'last_name' => 'required|max:255|min:3|string',
              'email' => 'required|email|confirmed|unique:users,email,' . $this->id . ',id,step,3',
              'phone' => 'required|numeric|max:11|starts_with:05',
              'date_of_birth' => 'required|date|date_format:Y-m-d|before:today',
              'country_id' => 'required|exists:countries,id',
              'city' => 'required|string',
              'address' => 'nullable|string|max:255',
              'insta_link' => 'nullable|string|max:20',
              'is_postal' => 'nullable|in:1,0',
        ];
    }
}
