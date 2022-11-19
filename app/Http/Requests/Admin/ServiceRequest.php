<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'is_active' => 'required|in:0,1',
            'ordering'  => 'required|numeric',
            'type'      => 'required|in:WorkWay,Store'
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules["$locale"]       = 'required|array';
            $rules["$locale.title"] = 'required|string|min:5|max:255';
            $rules["$locale.description"] = 'required|string|min:10|unique:slider_translations,title,' . @$this->slider?->id  . ',slider_id';
        }

        if (!$this->isMethod('PUT')) {
            $rules['image'] = 'required|image|max:10000';
        } else {
            $rules['image'] = 'nullable|image|max:10000';
        }

        return $rules;
    }
}
