<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class TrainerRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()

    {
        $rules= [
              'first_name' => 'required|min:2|max:255',
              'last_name' => 'required|min:2|max:255',
              'phone'=>'required',
              'countries'=>'required',
              'address'=>'required|string',
              'current_job'=>'required|string',
              'body_shape'=>'required',
              'is_certified'=>'required',
              'image'=>'required|image|max:2048',
              'email'=>'required|min:2|max:255|unique:users,email',
              'resume'=>'required|mimes:pdf,doc,docx|max:2048',

        ];
        if ($this->is_certified == 1){
            $rules['confidental_image']='required|image|max:2048';
        }

        return $rules;
    }

}
