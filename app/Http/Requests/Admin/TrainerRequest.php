<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TrainerRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
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
                'show_inPage'=>'required',
                'is_certified'=>'required',

        ];
        if ($this->is_certified == 1){
            $rules['confidental_image']='required|image|max:10000';
        }
        if (!$this->isMethod('PUT')) {
            $rules['password'] = 'required|min:8|confirmed';
            $rules['image'] = 'required|image|max:10000';
            $rules['email'] = 'required|min:2|max:255|unique:users,email';
            $rules['cv']='required|max:10000';

        } else {
            $rules['image'] = 'nullable|image|max:10000';
            $rules['confidental_image']='nullable|image|max:10000';
            $rules['email'] = 'required|min:2|max:255|unique:users,email,'.$this->trainer->user->id;
            $rules['cv']='nullable|max:10000';

        }
    return $rules;
    }
}
