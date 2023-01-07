<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SubscriptionDatatable;
use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Notifications\CancelSubscription;
use Illuminate\Support\Facades\Notification;

class SubscriptionController extends Controller
{
    public  function index(SubscriptionDatatable $subscriptionDatatable)
    {
        return $subscriptionDatatable->render('admin.subscriptions.index');
    }

    public function active($id)
    {
        $subscription = Subscription::find($id);
        $subscription->update([
            'status' => Subscription::ACTIVE,
            'status_ar' => 'مفعل'
        ]);

        return redirect()->back()->with('success', trans('updated_successfully'));
    }



    public function inactive($id)
    {
        $subscription = Subscription::find($id);
        $subscription->update([
            'status' => Subscription::IN_ACTIVE,
            'status_ar' => 'معطل'
        ]);
        $user = $subscription->user;
        $firebase_id = $user->firebase_token;

        $title = 'Village Diet';
        $content = trans('you_had_added_to_society');
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

        return redirect()->back()->with('success', trans('updated_successfully'));
    }
}
