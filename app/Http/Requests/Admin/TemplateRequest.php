<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TemplateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'is_active' => 'required|in:0,1',
            'template_name' => 'required|string'
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules["$locale"]       = 'required|array';
            $rules["$locale.subject"] = 'required|string|min:5|max:255|unique:template_translations,subject,' . @$this->template?->id  . ',template_id';
            $rules["$locale.content"] = 'required|string|min:10';
        }

        return $rules;
    }
}
