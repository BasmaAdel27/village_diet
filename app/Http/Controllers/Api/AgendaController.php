<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AgendaRequest;
use App\Http\Resources\Api\AgendaResource;
use App\Models\Meal\Meal;
use App\Models\Video\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Lang;
use stdClass;

class AgendaController extends Controller
{
    public function agenda(Request $request)
    {
        $user=auth()->user();
        $date=$request->date;
        if ($date <= Carbon::now()) {
            $data = new stdClass;
            $data->userInfo = $user->healthyInformation()
                  ->where(DB::raw('DATE(`created_at`)'), $date)
                  ->first();
            $data->meal = Meal::where(DB::raw('DATE(`created_at`)'), $date)
                  ->where('is_active', true)
                  ->WithTranslation()
                  ->latest()
                  ->first();

            $data->video = Video::where('is_active', true)
                  ->where(DB::raw('DATE(`created_at`)'), $date)
                  ->WithTranslation()
                  ->latest()
                  ->first();
            return successResponse(AgendaResource::make($data));

        }else{
            return failedResponse(Lang::get('date_wrong'));
        }
    }
}
