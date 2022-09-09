<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{


    public function index()
    {
        $settings=Setting::first();

        return view('admin.settings.edit',compact('settings'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(SettingRequest $request, $id)
    {
        $data=$request->validated();
        $settings=Setting::find($id);
        $settings->fill($data)->save();
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->storePublicly('settings', 'public');
            $settings->logo = $path;
            $settings->save();
        }

        return redirect()->route('admin.settings.index')->with('success',trans('updated_successfully'));

    }


    public function destroy($id)
    {
        //
    }
}
