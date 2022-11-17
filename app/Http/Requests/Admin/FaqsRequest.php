<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FaqsRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {

        $rules= [
              'is_active' => 'required|in:0,1',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules["$locale"]       = 'required|array';
            $rules["$locale.question"] ='required|string|min:30|unique:faq_translations,question,'. $this->common_question .',faq_id';
            $rules["$locale.answer"] = 'required|string|min:3|unique:faq_translations,answer,'. $this->common_question . ',faq_id';
        }
        return $rules;
    }

}
