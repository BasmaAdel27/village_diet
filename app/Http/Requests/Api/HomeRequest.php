<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class HomeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'sleep_hours' => 'nullable|numeric',
            'daily_cup_count' => 'nullable|numeric',
            'walk_duration' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'day_id' => 'required|exists:days,id',
        ];
    }
}
