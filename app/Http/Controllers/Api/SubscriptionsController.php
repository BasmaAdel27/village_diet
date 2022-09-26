<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SubscriptionsResource;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class SubscriptionsController extends Controller
{
    public function subscriptions(){
        $subscriptions=Subscription::where('user_id',auth()->user()->id)->get();
            return successResponse(SubscriptionsResource::collection($subscriptions));


    }

    public function cancelSubscription($id){
        $subscription=Subscription::find($id);
        if($subscription->status == 'active') {
            $subscription->status = 'request_cancel';
            $subscription->save();
            return successResponse(SubscriptionsResource::make($subscription), extra: ['message' => 'operation_accomplished_successfully']);
        }else{
            return failedResponse(Lang::get('You_cannot_unsubscribe'));
        }
    }
}
