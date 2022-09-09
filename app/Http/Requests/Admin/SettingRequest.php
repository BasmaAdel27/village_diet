<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
        return [
              'net_subscription' => 'required|numeric',
              'tax_name' => 'required|string|min:2|max:100',
              'tax_amount' => 'required|numeric',
              'tax_type' => 'required',
              'website_url' => 'required',
              'link_status'=>'required',
              'forced_android'=>'required',
              'forced_ios'=>'required',
              'optional_android'=>'required',
              'optional_ios'=>'required',
              'ios_version' => 'required|string|min:2|max:50',
              'android_version' => 'required|string|min:2|max:50',
              'web_maintenance' => 'required',
              'android_maintenance' => 'required',
              'ios_maintenance' => 'required',
              'website_title' => 'required|string|min:5|max:200',
              'website_description' =>'required|string|min:20',
              'logo' =>'required|image|mimes:png,jpg,jpeg,svg',
        ];
    }
}
