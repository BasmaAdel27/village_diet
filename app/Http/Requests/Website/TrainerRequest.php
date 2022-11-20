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
              'phone'=>'required|numeric',
              'bio'=>'required',
              'twitter'=>'nullable|max:255',
              'instagram'=>'nullable|max:255',
              'join_request_reason'=>'required',
              'country_id'=>'required|exists:countries,id',
              'state_id'=>'required|exists:states,id',
              'address'=>'required|string',
              'current_job'=>'required|string',
              'body_shape'=>'required',
              'is_certified'=>'required|in:0,1',
              'image'=>'required|image|max:2048',
              'email'=>'required|min:2|max:255|unique:users,email',
              'cv'=>'required|mimes:pdf,doc,docx|max:2048',

        ];
        if ($this->is_certified == 1){
            $rules['confidental_image']='required|image|max:2048';
        }

        return $rules;
    }

}
