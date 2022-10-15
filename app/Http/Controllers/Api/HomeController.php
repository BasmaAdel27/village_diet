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
use Illuminate\Support\Facades\Lang;
use stdClass;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->currentSubscription->status == 'active' || $user->currentSubscription->status == 'request_cancel' ) {
            $day = now()->diffInDays($user->currentSubscription->created_at) + 1;
            $dayId = Day::select('id')->where('number', $day)->value('id');
            $obj = new stdClass;
            $obj->slides = Slider::where('is_active', true)
                  ->where('is_show_in_app', true)
                  ->get();
            if ($user->society()->exists() && $user->society->is_active == 1) {
                $obj->userInfo = $user->healthyInformation()
                      ->where('day_id', $dayId)
                      ->first();

                $obj->meal = Meal::where('day_id', $dayId)
                      ->where('is_active', true)
                      ->latest()
                      ->first();

                $obj->video = Video::where('is_active', true)
                      ->where('day_id', $dayId)
                      ->latest()
                      ->first();
                $obj->society = true;


                return successResponse(HomeResource::make($obj));
            } else {
                $obj->userInfo = null;
                $obj->meal = Meal::where('day_id', 1)
                      ->where('is_active', true)
                      ->latest()
                      ->first();
                $obj->video = Video::where('is_active', true)
                      ->where('day_id', 1)
                      ->latest()
                      ->first();

                $obj->society = false;

                return successResponse(HomeResource::make($obj));
            }
        }else{
            return failedResponse(Lang::get('unauthorized'),401);
        }
    }

    public function store(HomeRequest $request)
    {
        $user = auth()->user();
        if ($user->society()->exists() && $user->society->is_active == 1) {
            $healthData = $user->healthyInformation()
                ->updateOrCreate(
                    ['day_id' => $request->day_id],
                    $request->validated() + ['subscription_id' => $user->currentSubscription->id]
                );

            return successResponse(UserInfoResource::make($healthData), message: __('created_successfully'));
        } else {
            $data['society'] = false;
            return successResponse($data);
        }
    }
}
