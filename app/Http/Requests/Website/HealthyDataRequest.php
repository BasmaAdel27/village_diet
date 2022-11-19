<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class HealthyDataRequest extends FormRequest
{
    public function rules()
    {
        return [
            "q2" => 'required',
            "q4" => 'required',
            "q9" => 'required',
            "q10" => 'required',
            "q11" => 'required',
            "q12" => 'required',
            "q14" => 'required',
            "q16" => 'required',
            "q18" => 'required',
            "q19" => 'required',
            "q21" => 'required',
            "q23" => 'required',
            "q25" => 'required',
            "q28" => 'required',
            "q30" => 'required',
            "q32" => 'required',
            "q34" => 'required',
            "q36" => 'required',
            "q37" => 'required',
            "q38" => 'required',
            "q39" => 'required',
            "q40" => 'required',
            "q41" => 'required',
        ];
    }
}
