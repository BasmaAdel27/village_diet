<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SubscriptionDatatable;
use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public  function index(SubscriptionDatatable $subscriptionDatatable){
        return $subscriptionDatatable->render('admin.subscriptions.index');
    }

    public function active($id){
        $subscription=Subscription::find($id);
        $subscription->update([
              'status' => Subscription::ACTIVE,
              'status_ar'=>Subscription::ACTIVE_AR
        ]);
        return redirect()->back()->with('success',trans('updated_successfully'));
    }

    public function cancel($id){
        $subscription=Subscription::find($id);
        $subscription->update([
              'status' => Subscription::REQUEST_CANCEL,
              'status_ar'=>Subscription::REQUEST_CANCEL_AR
        ]);
        return redirect()->back()->with('success',trans('updated_successfully'));
    }

    public function inactive($id){
        $subscription=Subscription::find($id);
        $subscription->update([
              'status' => Subscription::IN_ACTIVE,
              'status_ar'=>Subscription::INACTIVE_AR
        ]);
        return redirect()->back()->with('success',trans('updated_successfully'));
    }
}
