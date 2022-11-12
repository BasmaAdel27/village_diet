<?php

namespace App\Http\Requests\Website;

use App\Models\ContactUs;
use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
          'full_name' => 'nullable',
          'email' => 'required',
          'title' => 'nullable',
          'user_type' =>'required|in:' . implode(',', ContactUs::USER_TYPES),
          'message_type' => 'required|in:' . implode(',', ContactUs::MESSAGE_TYPES),
          'content' => 'required',
          'phone' => 'nullable',
          'whatsapp_phone' => 'nullable',
    ];
    }
}
