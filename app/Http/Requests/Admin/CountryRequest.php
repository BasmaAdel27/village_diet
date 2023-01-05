<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }



    public function rules()
    {
        $rules=[
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules["$locale"]       = 'required|array';
            $rules["$locale.name"] ='required|string';

        }
        return $rules;
    }
}
