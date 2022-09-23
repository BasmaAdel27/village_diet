<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_number' => 'required|numeric',
            'device_type' => 'nullable',
            'device_token' => 'nullable'
        ];
    }
}
