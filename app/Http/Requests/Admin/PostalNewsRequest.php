<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostalNewsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "title" => "required|string|max:255",
            "template" => "required|exists:templates,id",
            "emails" => "required|array|min:1",
            "emails.*" => "required|email"
        ];
    }
}
