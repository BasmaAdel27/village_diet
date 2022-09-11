<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ReportCouponDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReportRequest;
use App\Models\Society\Society;
use App\Models\Subscription;
use App\Models\Trainer;
use App\Models\User;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin.reports.subscriptions')->only(['subscriptionsReport']);
        $this->middleware('permission:admin.reports.users')->only(['usersReport']);
        $this->middleware('permission:admin.reports.trainers')->only(['trainersReport']);
        $this->middleware('permission:admin.reports.copouns')->only(['copounsReport']);

        $this->date_from = Carbon::parse(request('date_from'))->format('Y-m-d');
        $this->date_to   = Carbon::parse(request('date_to'))->format('Y-m-d');
    }

    public function subscriptionsReport(ReportRequest $request)
    {
        $data['countOfUsers'] = Subscription::select('user_id')
            ->dateBetween($this->date_from, $this->date_to)
            ->get()->unique('user_id')->count();

        $data['sumOfSubscriptions'] = Subscription::query()
            ->dateBetween($this->date_from, $this->date_to)
            ->sum('total_amount');

        $data['sumOftaxs'] = Subscription::query()
            ->dateBetween($this->date_from, $this->date_to)
            ->sum('tax_amount');

        $data['sumOfCoupons'] = Subscription::withSum('coupon', 'amount')
            ->dateBetween($this->date_from, $this->date_to)
            ->get()->sum('coupon_sum_amount');

        $data['total'] = ($data['sumOfSubscriptions'] + $data['sumOftaxs']) - $data['sumOfCoupons'];

        return view('admin.reports.subscriptions', compact('data'));
    }

    public function usersReport(ReportRequest $request)
    {
        $data['activeSubscripersCount'] = User::whereHas('subscriptions', fn ($q) => $q->where('status', Subscription::ACTIVE))->count();
        $data['finishedSubscripersCount'] = User::whereHas('subscriptions', fn ($q) => $q->where('status', Subscription::FINISHED))->count();
        $data['inactiveSubscripersCount'] = User::whereHas('subscriptions', fn ($q) => $q->where('status', Subscription::IN_ACTIVE))->count();
        $data['total'] = $data['activeSubscripersCount'] +
            $data['finishedSubscripersCount'] +
            $data['inactiveSubscripersCount'];

        return view('admin.reports.users', compact('data'));
    }

    public function trainersReport(ReportRequest $request)
    {
        $data['activeTrainers'] = User::whereHas(
            'trainer',
            fn ($q) => $q->where('status', Trainer::DONE)
        )->count();

        $data['inactiveTrainers'] = User::whereHas(
            'trainer',
            fn ($q) => $q->where('status', Trainer::PENDING)
        )->count();

        $data['societyCount'] = Society::count();
        $data['totalOfTrainers'] = $data['activeTrainers'] + $data['inactiveTrainers'];


        return view('admin.reports.trainers', compact('data'));
    }

    public function copounsReport(ReportRequest $request, ReportCouponDatatable $reportCouponDatatable)
    {
        return $reportCouponDatatable->render('admin.reports.copouns');
    }
}
