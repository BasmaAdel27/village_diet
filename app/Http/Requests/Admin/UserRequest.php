<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
              'first_name' => 'required',
              'last_name' => 'required',
              'email' => 'required|unique:users,email,' . $this->user?->id,
              'phone' => 'required',
              'date_of_birth' => 'required',
              'country_id' => 'required',
              'city' => 'nullable',
              'address' => 'nullable|string|max:255',
              'insta_link' => 'required',
        ];
    }
}
