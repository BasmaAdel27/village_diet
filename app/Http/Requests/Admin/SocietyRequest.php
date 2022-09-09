<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SocietyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'trainer_id' => 'required|exists:users,id',
            'is_active' => 'required|in:0,1',
            'user_id' => 'required|array|min:1',
            'user_id.*' => 'exists:users,id'
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules["$locale"]       = 'required|array';
            $rules["$locale.title"] = 'required|string|min:10|max:255|unique:society_translations,title,' . @$this->society?->id  . ',society_id';
        }

        return $rules;
    }
}
