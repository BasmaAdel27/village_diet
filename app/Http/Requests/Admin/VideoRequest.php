<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        $rules = [
            'is_active' => 'required|in:0,1',
            'day_id'    => 'required|exists:days,id',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules["$locale"]       = 'required|array';
            $rules["$locale.title"] = 'required|string|min:5|max:255|unique:video_translations,title,' . @$this->video?->id  . ',video_id';
        }
        // TODO: Add Mimetypes for validate videos
        // TODO: Check post_max_size value on server
        if (!$this->isMethod('PUT')) {
            $rules['video'] = 'required|max:102400';
        } else {
            $rules['video'] = 'nullable|max:102400';
        }

        return $rules;
    }
}
