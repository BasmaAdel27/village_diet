<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\subscriptions\LogsResource;
use App\Http\Resources\Api\SubscriptionsResource;
use App\Models\Subscription;
use stdClass;

class SubscriptionsController extends Controller
{
    public function subscriptions()
    {
        $data = new stdClass();
        $user = auth()->user();

        $data->logs = $user->subscriptions()->where('id', '<>', $user->currentSubscription->id)->get();
        $data->active_subscription = $user->currentSubscription;

        return successResponse(SubscriptionsResource::make($data));
    }

    public function cancelSubscription()
    {
        $currentSubscription = auth()->user()->currentSubscription;
        $currentSubscription->update(['status' => Subscription::REQUEST_CANCEL]);

        return successResponse(LogsResource::make($currentSubscription), message: trans(
            'cancel_successfully',
            ['date' => $currentSubscription->end_date->toDateString()]
        ));
    }
}
