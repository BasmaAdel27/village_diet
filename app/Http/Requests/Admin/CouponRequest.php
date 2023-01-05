<?php

namespace App\Http\Requests\Admin;

use Carbon\Carbon;
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
        $dt = Carbon::now()->format('Y-m-d');
        $rules = [
            'code' => 'required',
            'activate_date' => 'required|after_or_equal:'.$dt,
            'end_date' => 'required|after_or_equal:activate_date',
            'amount' => 'required|numeric',
            'max_used' => 'required|numeric',
            'coupon_type' => 'required',
        ];

        return $rules;
    }
}
