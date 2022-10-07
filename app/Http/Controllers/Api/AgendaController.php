<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\AgendaResource;
use App\Http\Resources\Api\DateSubscriptionResource;
use App\Models\Day\Day;
use App\Models\Meal\Meal;
use App\Models\Video\Video;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use stdClass;

class AgendaController extends Controller
{
    public function agendaDate()
    {
        $currentSubscription = auth()->user()->currentSubscription;
        if (!$currentSubscription) return failedResponse(trans('not_subscription'));

        $startDate = Carbon::parse($currentSubscription->created_at)->format('Y-m-d');
        $endDate = Carbon::parse($currentSubscription->end_date)->format('Y-m-d');
        $dates = CarbonPeriod::create($startDate, $endDate)->toArray();
        $days = Day::get();

        foreach ($days as $index => $day) {
            if (!isset($dates[$day->number])) continue;

            $data[$index]['day_id'] = $day->id;
            $data[$index]['date'] = @$dates[$day->number]?->toDateString();
            $data[$index]['status'] = (bool) now()->gt(@$dates[$day->number]);
            $data[$index]['day']  = $day->title;
        }

        return successResponse($data);
    }



    public function agenda(Request $request, $day_id)
    {
        $user = auth()->user();
        $date = $request->date;
        if ($date <= Carbon::now()->toDateString()) {
            $data = new stdClass;
            $data->userInfo = $user->healthyInformation()
                ->where('day_id', $day_id)
                ->first();
            $data->meal = Meal::where('day_id', $day_id)
                ->where('is_active', true)
                ->latest()
                ->first();

            $data->video = Video::where('is_active', true)
                ->where('day_id', $day_id)
                ->latest()
                ->first();
            if ($data->userInfo != null || $data->meal != null || $data->video != null) {
                return successResponse(AgendaResource::make($data));
            } else {
                return failedResponse(Lang::get('nothing_data'),200);
            }
        } else {
            return failedResponse(Lang::get('date_wrong'));
        }
    }
}
