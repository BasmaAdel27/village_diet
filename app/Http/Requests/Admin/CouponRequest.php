<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'code'=>'required|min:6|max:6',
            'activate_date'=>'required',
            'end_date'=>'required',
            'amount'=>'required|numeric',
            'max_used'=>'required|numeric',
            'used_times'=>'required|numeric',
        ];

        return $rules;
    }
}
