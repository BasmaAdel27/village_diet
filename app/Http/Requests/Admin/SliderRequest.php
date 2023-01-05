<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'is_active' => 'required|in:0,1',
            'link' => 'required|string',
            'is_show_in_app' => 'required|in:0,1',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules["$locale"]       = 'required|array';
            $rules["$locale.title"] = 'required|string|min:5|max:255';
            $rules["$locale.description"] = 'required|string|min:10|max:255|unique:slider_translations,title,' . @$this->slider?->id  . ',slider_id';
        }

        return $rules;
    }
}
