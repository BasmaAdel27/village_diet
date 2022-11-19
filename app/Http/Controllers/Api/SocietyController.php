<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SocietyStatusResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SocietyController extends Controller
{
    public function societyStatus()
    {
        $user = auth()->user();

        if ($user->society()->doesntExist()) {
            $data['society_status'] = false;
            $data['subscription_status'] = $user->currentSubscription->status;
            $data['notification_unread'] = $user->unreadNotifications()->count();
            $data['subscription_day'] = trans('start_when_society_begin');

            return successResponse($data, message: trans('Please_wait_it_will_start_soon'));
        } else {
            if ($user->society->is_active == 0) {
                Carbon::setLocale('ar');
                $date_from = Carbon::parse($user->society->date_from)->format('Y - m - d');
                $data['society_status'] = true;
                $data['subscription_status'] = $user->currentSubscription->status;
                $data['notification_unread'] = $user->unreadNotifications()->count();
                $data['trainer_id'] = $user->society->trainer->id;

                return successResponse($data, message: trans('The_counting_of_days_will_start_from_') . $date_from);
            } else {

                return successResponse(SocietyStatusResource::make(\auth()->user()));
            }
        }
    }
}
