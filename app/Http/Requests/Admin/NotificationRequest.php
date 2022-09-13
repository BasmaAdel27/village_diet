<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.title' => 'required|string|min:3|max:500',
            'data.content' => 'required|string|min:3',
            'type' => 'required|string',
        ];
    }
}
