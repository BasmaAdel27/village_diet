<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\subscriptions\LogsResource;
use App\Http\Resources\Api\SubscriptionsResource;
use App\Models\Subscription;
use App\Notifications\CancelSubscription;
use App\Services\Payment;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Notification;
use stdClass;

class SubscriptionsController extends Controller
{
    public function subscriptions()
    {
        $data = new stdClass();
        $user = auth()->user();
        $data->logs = $user->subscriptions()->where('id', '<>', $user->currentSubscription?->id)->get();
        $data->active_subscription = $user->currentSubscription;
        if ($user->currentSubscription?->status == 'request_cancel' || ($user->currentSubscription?->status == 'in_active' && $user?->currentSubscription->end_date <= now())) {
            $user->currentSubscription?->update(['status' => Subscription::FINISHED]);
        }
        return successResponse(SubscriptionsResource::make($data));
    }

    public function cancelSubscription()
    {
        $user = auth()->user();


//        TODO:: call GetRecurringPayment api to list all Recurring Payment
        $GetRecurringPayment = Payment::GetRecurringPayment();

//        TODO:: get invoice id from current Subscription and match it with GetRecurringPayment to get                        RecurringId

        $invoice_id = $user->currentSubscription->invoice_id;
        $recurringId = 0;
        foreach ($GetRecurringPayment['Data']['RecurringPayment'] as $recurringPayment) {
            if (count($recurringPayment['RecurringInvoices']) > 0) {
                foreach ($recurringPayment['RecurringInvoices'] as $RecurringInvoice) {
                    if ($RecurringInvoice == $invoice_id) {
                        $recurringId = $recurringPayment->RecurringId;
                    }
                }
            }
        }
//        TODO:: use CancelRecurringPayment api to cancel it
              $recurringId != 0 ?? Payment::CancelRecurringPayment($recurringId);

        if ($user->currentSubscription->status == 'active' && $user->society()->exists()) {
            $currentSubscription = $user->currentSubscription;
            $currentSubscription->update(['status' => Subscription::REQUEST_CANCEL]);

            $firebase_id = $user->firebase_token;

            $title = 'Village Diet';
            $content = trans('your_subscription_is_cancelled');
            $message = [
                  'title' => 'village_diet',
                  'title_ar' => 'فيليج دايت',
                  'body' => 'The subscription has been cancelled.. Your subscription will continue until the end of the month',
                  'body_ar' => ' تم الغاء الاشتراك .. سيستمر اشتراكك حتى نهاية الشهر',
                  'type' => 'society',
            ];

            Notification::send($user, new CancelSubscription());
            if ($firebase_id) {
                send_notification([$user->firebase_token], $content, $title, $message);
            }

            return successResponse(LogsResource::make($currentSubscription), message: trans(
                  'cancel_successfully',
                  ['date' => $currentSubscription->end_date->toDateString()]
            ));
        } else {
            return failedResponse(Lang::get('unauthorized'));
        }
    }
}
