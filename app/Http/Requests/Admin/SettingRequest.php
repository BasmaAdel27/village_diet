<?php

namespace App\Http\Requests\Admin;

use App\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'net_subscription' => 'required|numeric',
            'tax_name' => 'required|string|min:2|max:100',
            'tax_amount' => 'required|numeric',
            'tax_type' => 'required|in:' . implode(',', Setting::TAX_TYPES),
            'website_url' => 'required',
            'link_status' => 'required',
            'forced_android' => 'required',
            'forced_ios' => 'required',
            'optional_android' => 'required',
            'optional_ios' => 'required',
            'ios_version' => 'required|string|min:2|max:50',
            'android_version' => 'required|string|min:2|max:50',
            'web_maintenance' => 'required',
            'android_maintenance' => 'nullable',
            'ios_maintenance' => 'nullable',
            'website_title' => 'required|string|min:5|max:200',
            'website_description' => 'required|string|min:5|max:200',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email'=>'required|email',
            'whatsapp_number' => 'required',
            'facebook' => 'nullable|string',
            'twitter' => 'nullable|string',
            'youtube' => 'nullable|string',
            'snapchat' => 'nullable|string',
            'tiktok' => 'nullable|string',
            'instagram' => 'nullable|string',
            'android_url'=>'nullable',
            'ios_url'=>'nullable',
            'visit_store'=>'nullable',
            'linkedin'=>'nullable',
            'lifestyle_link'=>'nullable',
        ];
    }
}
