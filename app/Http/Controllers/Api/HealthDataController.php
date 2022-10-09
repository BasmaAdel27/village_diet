<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HealthyInformation;

class HealthDataController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $data = HealthyInformation::select(['weight', 'sleep_hours', 'daily_cup_count', 'walk_duration', 'day_translations.title'])
            ->join('day_translations', 'healthy_information.day_id', 'day_translations.day_id')
            ->where('locale', app()->getLocale())
            ->where('user_id', $user->id)
            ->where('subscription_id', $user->currentSubscription->id)
            ->get();

        $charts['weights'] = $data->pluck('weight', 'title')->transform(function ($day, $item) {
            $data['weights'] = $item;
            $data['day'] = $day;

            return $data;
        })->values();
        $charts['daily_cup_count'] = $data->pluck('daily_cup_count', 'title')->transform(function ($day, $item) {
            $data['daily_cup_count'] = $item;
            $data['day'] = $day;

            return $data;
        })->values();
        $charts['walk_duration'] = $data->pluck('walk_duration', 'title')->transform(function ($day, $item) {
            $data['walk_duration'] = $item;
            $data['day'] = $day;

            return $data;
        })->values();
        $charts['sleepHours'] = $data->pluck('sleep_hours', 'title')->transform(function ($day, $item) {
            $data['sleepHours'] = $item;
            $data['day'] = $day;

            return $data;
        })->values();

        return successResponse($charts);
    }
}
