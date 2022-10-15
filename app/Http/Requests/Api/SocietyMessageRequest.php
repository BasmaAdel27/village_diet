<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SocietyMessageRequest extends FormRequest
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
        $rules =[
              'type' => 'required|in:TEXT,IMAGE,AUDIO',
        ];

        if ($this->type =='TEXT'){
            $rules['message']='required';
        }elseif ($this->type =='IMAGE'){
            $rules['message']='required|image|mimes:jpeg,jpg,png,gif|max:2048';
        }elseif($this->type =='AUDIO'){
            $rules['message'] = 'required|file|mimes:audio/mpeg,mpga,mp3,wav,aac,ogg,mp4,m4a,mkv';
        }

        return $rules;
    }

}
