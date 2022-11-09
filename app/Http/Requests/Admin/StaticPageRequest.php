<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StaticPageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'is_active' => 'required|in:0,1',
            'is_show_in_app' => 'required|in:0,1',
            'slug'=>'nullable'

        ];

        foreach (config('translatable.locales') as $locale) {
            $rules["$locale"]       = 'required|array';
            $rules["$locale.title"] = 'required|string|min:5|max:255|unique:static_page_translations,title,' . @$this->static_page?->id  . ',static_page_id';
            $rules["$locale.content"] = 'required|string|min:10';
        }

        if (!$this->isMethod('PUT')) {
            $rules['image'] = 'required|image|max:10000';
        } else {
            $rules['image'] = 'nullable|image|max:10000';
        }

        return $rules;
    }
}
