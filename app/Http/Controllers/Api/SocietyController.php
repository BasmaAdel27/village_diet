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
            $data['notification_unread'] = $user->unreadNotifications()->count();

            return successResponse($data, message: trans('Please_wait_it_will_start_soon'));
        }

        if ($user->society()->exists() && $user->society->is_active == 0) {
            Carbon::setLocale('ar');
            $date_from = Carbon::parse($user->society->date_from)->format('Y-m-d');

            $data['society_status'] = true;
            $data['notification_unread'] = $user->unreadNotifications()->count();

            return successResponse($data, message: trans('The_counting_of_days_will_start_from_') . $date_from);
        } elseif ($user->society()->exists() && $user->society->is_active == 1) {
            $user = Auth::user();

            return successResponse(SocietyStatusResource::make($user));
        }
    }
}
