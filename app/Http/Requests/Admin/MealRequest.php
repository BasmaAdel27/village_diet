<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MealRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $rules= [
              'is_active' => 'required|in:0,1',
              'day_id'    => 'required|exists:days,id',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules["$locale"]       = 'required|array';
            $rules["$locale.breakfast"] ='required|string|min:30|unique:meal_translations,breakfast,' . $this->meal  . ',meal_id';
            $rules["$locale.lunch"] = 'required|string|min:30|unique:meal_translations,lunch,' . $this->meal  . ',meal_id';
            $rules["$locale.dinner"] = 'required|string|min:30|unique:meal_translations,dinner,' . $this->meal  . ',meal_id';
        }
        return $rules;
    }
}
