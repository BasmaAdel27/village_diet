<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AddFirebaseRequest extends FormRequest
{
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'firebase_token' => 'required|string'
        ];
    }
}
