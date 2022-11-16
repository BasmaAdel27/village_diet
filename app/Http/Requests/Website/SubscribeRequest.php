<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class SubscribeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email'
        ];
    }
}
