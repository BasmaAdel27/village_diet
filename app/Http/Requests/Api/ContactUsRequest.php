<?php

namespace App\Http\Requests\Api;

use App\Models\ContactUs;
use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
{

    public function authorize()
    {
        return True;
    }


    public function rules()
    {
        return [
            'full_name' => 'nullable',
            'email' => 'nullable',
            'title' => 'nullable',
            'message_type' => 'required|in:' . implode(',', ContactUs::MESSAGE_TYPES),
            'content' => 'required',
            'phone' => 'nullable',
            'whatsapp_phone' => 'nullable',
        ];
    }
}
