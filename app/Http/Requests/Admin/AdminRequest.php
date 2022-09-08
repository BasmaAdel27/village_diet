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
        $rules = [
            'first_name' => 'required|min:2|max:255',
            'last_name' => 'required|min:2|max:255',
            'email' => 'required|min:2|max:255|unique:users,email,' . $this->admin?->id,
            'role_id' => 'required|exists:roles,id',
        ];

        if (!$this->isMethod('PUT'))
            $rules['password'] = 'required|min:8|confirmed';

        return $rules;
    }
}
