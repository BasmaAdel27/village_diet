<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\SubscribeRequest;
use App\Models\Subscriber;

class SubscribeController extends Controller
{
    public function subscribe(SubscribeRequest $request)
    {
        $data = $request->validated();
        Subscriber::create($data);

        return redirect()->back()->with('success', trans('subscribe_successfully'));
    }
}
