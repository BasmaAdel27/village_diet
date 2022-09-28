<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\subscriptions\LogsResource;
use App\Http\Resources\Api\SubscriptionsResource;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use stdClass;

class SubscriptionsController extends Controller
{
    public function subscriptions(){
        $data=new stdClass();
        $subscriptions=Auth::user()->subscriptions;
        $data->logs=collect($subscriptions)->where('status','!=','active');
        $data->active_subscription=collect($subscriptions)->where('status','==','active');
        $data->subscription_count=User::find(\auth()->user()->id);
            return successResponse(SubscriptionsResource::make($data));


    }

    public function cancelSubscription($id){
        $subscription=Subscription::find($id);
        if($subscription->status == 'active') {
            $subscription->status = 'request_cancel';
            $subscription->save();
            return successResponse(LogsResource::make($subscription), extra: ['message' => 'operation_accomplished_successfully']);
        }else{
            return failedResponse(Lang::get('You_cannot_unsubscribe'));
        }
    }
}
