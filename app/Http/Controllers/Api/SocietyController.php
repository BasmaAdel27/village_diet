<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\DayResource;
use App\Models\Day\Day;
use Carbon\Carbon;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class SocietyController extends Controller
{
    public function societyStatus(){
        $user=\auth()->user();
        if ($user->society()->doesntExist()){
            $data['society_status']=false;
            $data['notification_unread']=$user->unreadNotifications()->count();
            return successResponse($data, message: trans('Please_wait_it_will_start_soon'));
        }

        if ($user->society()->exists() && $user->society->is_active == 0 ){
            Carbon::setLocale('ar');
            $date_from=date('Y-m-d', strtotime($user->society->date_from));
            $data['society_status']=true;
            $data['notification_unread']=$user->unreadNotifications()->count();
            return successResponse($data, message: trans('The_counting_of_days_will_start_from_').$date_from);

        }elseif ($user->society()->exists() && $user->society->is_active == 1){
            $dayNumber = now()->diffInDays($user->currentSubscription->created_at) + 1;
            $day['day_id'] = Day::select('id')->where('number', $dayNumber)->value('id');
            $day['notification_unread']=$user->unreadNotifications()->count();
            return successResponse($day);
        }

    }
}
