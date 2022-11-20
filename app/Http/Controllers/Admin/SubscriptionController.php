<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SubscriptionDatatable;
use App\Http\Controllers\Controller;
use App\Models\Subscription;

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

        return redirect()->back()->with('success', trans('updated_successfully'));
    }
}
