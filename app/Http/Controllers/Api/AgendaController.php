<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AgendaRequest;
use App\Http\Resources\Api\AgendaResource;
use App\Http\Resources\Api\DateSubscriptionResource;
use App\Models\Day\Day;
use App\Models\Meal\Meal;
use App\Models\Video\Video;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Lang;
use stdClass;

class AgendaController extends Controller
{
    public function agendaDate(){
        $user=Auth::user();
        $data=new stdClass;
        $data->current_Subscription=$user->currentSubscription()->first();
        $startDate = Carbon::createFromFormat('Y-m-d', $user->currentSubscription->created_at);
        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $user->currentSubscription->end_date)->toDateString();
        $dateRange = CarbonPeriod::create($startDate, $endDate);
        $dates=$dateRange->toArray();
        $days = Day::select('id','number')->get('id','number');
        $allDays=[];
        array_push($allDays,DateSubscriptionResource::make($data));
        Foreach($dates as $index => $date){
            $day['day'] = $days[$index];
            $day['date'] = $date->toDateString();
            array_push($allDays,$day);
        }
        return successResponse($allDays);

    }



    public function agenda(Request $request,$day_id)
    {
        $user=auth()->user();
        $date=$request->date;
        if ($date <= Carbon::now()->toDateString()) {
            $data = new stdClass;
            $data->userInfo = $user->healthyInformation()
                  ->where('day_id', $day_id)
                  ->first();
            $data->meal = Meal::where('day_id', $day_id)
                  ->where('is_active', true)
                  ->WithTranslation()
                  ->latest()
                  ->first();

            $data->video = Video::where('is_active', true)
                  ->where('day_id', $day_id)
                  ->WithTranslation()
                  ->latest()
                  ->first();
            if ($data->userInfo != null || $data->meal != null || $data->video !=null ){
                return successResponse(AgendaResource::make($data));
            }else{
                return failedResponse(Lang::get('nothing_data'));
            }

        }else{
            return failedResponse(Lang::get('date_wrong'));
        }
    }
}
