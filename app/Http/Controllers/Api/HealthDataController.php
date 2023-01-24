<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HealthyInformation;

class HealthDataController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $data = HealthyInformation::select(['days.number', 'weight', 'sleep_hours', 'daily_cup_count', 'walk_duration', 'day_translations.title'])
            ->join('days', 'healthy_information.day_id', 'days.id')
            ->join('day_translations', 'healthy_information.day_id', 'day_translations.day_id')
            ->where('locale', app()->getLocale())
            ->where('user_id', $user->id)
            ->where('subscription_id', $user->currentSubscription->id)
            ->orderBy('day_translations.id')
            ->get();

        $charts['weights'] = $data->map(function ($item) {
            $data['weights'] = $item['weight'] ?? "0";
            $data['number'] = $item['number'];
            $data['day'] = $item['title'] ?? null;

            return $data;
        })->values();
        $charts['daily_cup_count'] = $data->map(function ($item) {

            $data['daily_cup_count'] = $item['daily_cup_count'] ?? "0";
            $data['number'] = $item['number'];
            $data['day'] = $item['title'] ?? null;
            return $data;
        })->values();
        $charts['walk_duration'] = $data->map(function ($item) {
            $data['walk_duration'] = $item['walk_duration'] ?? "0";
            $data['number'] = $item['number'];
            $data['day'] = $item['title'] ?? null;

            return $data;
        })->values();
        $charts['sleepHours'] = $data->map(function ($item) {
            $data['sleepHours'] = $item['sleep_hours'] ?? "0";
            $data['number'] = $item['number'];
            $data['day'] = $item['title'] ?? null;

            return $data;
        })->values();

        return successResponse($charts);
    }
}
