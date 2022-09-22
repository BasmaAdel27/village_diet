<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::first();

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(SettingRequest $request, Setting $setting)
    {
        $data = $request->validated();
        $setting->fill($data)->save();
        $setting->footer=$data['footer'];
        $setting->save();
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->storePublicly('settings', 'public');
            $setting->logo = $path;
            $setting->save();
        }

        return redirect()->route('admin.settings.index')->with('success', trans('updated_successfully'));
    }
}
