<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $rules =[
              'receiver_id'=>'required',
              'type'=>'required',

        ];

        if ($this->type =='TEXT'){
            $rules['message']='required';
        }elseif ($this->type =='IMAGE'){
            $rules['message']='required|image|mimes:jpeg,jpg,png,gif|max:2048';
        }elseif($this->type =='AUDIO'){
            $rules['message']='required|file|mimes:audio/mpeg,mpga,mp3,wav,aac,mp4,ogg';
        }

        return $rules;
    }
}
