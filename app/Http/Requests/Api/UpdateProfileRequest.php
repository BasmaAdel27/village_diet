<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // 'first_name' => 'nullable|string',
            // 'last_name' => 'nullable|string',
            // 'email' => 'nullable|unique:users,email,' . auth()->id(),
            // 'phone' => 'nullable|numeric',
            'image' => 'nullable|image'
        ];
    }
}
