<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|min:2|max:255',
            'last_name' => 'required|min:2|max:255',
            'email' => 'required|min:2|max:255|unique:users,email,' . $this->admin?->id,
            'password' => 'required|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ];
    }
}
