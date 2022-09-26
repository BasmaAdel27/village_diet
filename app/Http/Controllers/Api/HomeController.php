<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\HomeRequest;
use App\Http\Resources\Api\Home\UserInfoResource;
use App\Http\Resources\Api\HomeResource;
use App\Models\Day\Day;
use App\Models\Meal\Meal;
use App\Models\Slider\Slider;
use App\Models\Video\Video;
use stdClass;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $day = now()->diffInDays($user->subscription->created_at);
        $dayId = Day::select('id')->where('number', $day)->value('id');
        $obj = new stdClass;

        $obj->slides = Slider::where('is_active', true)
            ->where('is_show_in_app', true)
            ->WithTranslation()
            ->get();

        $obj->userInfo = $user->healthyInformation()
            ->where('day_id', $dayId)
            ->first();

        $obj->meal = Meal::where('day_id', $dayId)
            ->where('is_active', true)
            ->WithTranslation()
            ->latest()
            ->first();

        $obj->video = Video::where('is_active', true)
            ->where('day_id', $dayId)
            ->WithTranslation()
            ->latest()
            ->first();

        return successResponse(HomeResource::make($obj));
    }

    public function store(HomeRequest $request)
    {
        $user = auth()->user();
        $healthData = $user->healthyInformation()
            ->updateOrCreate(
                ['day_id' => $request->day_id],
                $request->validated() + ['subscription_id' => $user->subscription->id]
            );

        return successResponse(UserInfoResource::make($healthData), message: __('created_successfully'));
    }
}
