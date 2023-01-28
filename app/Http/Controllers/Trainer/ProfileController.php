<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('admin.profile.index', compact('user'));
    }

    public function store(ProfileRequest $request)
    {
        $data  = $request->validated();
        if ($data['password'] == null) unset($data['password']);
        auth()->user()->fill($data)->save();

        return back()->with('success', trans('updated_successfully'));
    }
}
