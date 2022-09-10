<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReportRequest;
use App\Models\Subscription;
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
        return view('admin.reports.subscriptions');
    }

    public function usersReport(ReportRequest $request)
    {
        return view('admin.reports.users');
    }

    public function trainersReport(ReportRequest $request)
    {
        return view('admin.reports.trainers');
    }

    public function copounsReport(ReportRequest $request)
    {
        return view('admin.reports.copouns');
    }
}
