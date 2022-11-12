<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CustomerOpinionRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $rules= [
              'name' => 'required',
              'content' => 'required',

        ];
        if (!$this->isMethod('PUT')) {
            $rules['image'] = 'required|image|max:10000';

        }else{
            $rules['image'] = 'nullable|image|max:10000';

        }
        return $rules;
    }
}
