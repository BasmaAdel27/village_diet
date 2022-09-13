<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\UserDatatable;
use App\Http\Controllers\Controller;
use App\Models\HealthyInformation;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin.users.index')->only(['index']);
        $this->middleware('permission:admin.users.statistics')->only(['statistics']);
        $this->middleware('permission:admin.users.store')->only(['store']);
        $this->middleware('permission:admin.users.update')->only(['update']);
        $this->middleware('permission:admin.users.destroy')->only(['destroy']);
    }

    public function index(UserDatatable $userDatatable)
    {
        return $userDatatable->render('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }


    public function store(Request $request)
    {
        //
    }

    public function edit($id)
    {
        return view('admin.users.edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function statistics(User $user)
    {
        $data = HealthyInformation::select(['weight', 'sleep_hours', 'daily_cup_count', 'day_translations.title'])
            ->join('day_translations', 'healthy_information.day_id', 'day_translations.day_id')
            ->where('locale', app()->getLocale())
            ->where('user_id', $user->id)
            ->where('healthy_information.created_at', '>=', today()->startOfMonth())
            ->where('healthy_information.created_at', '<=', today()->endOfMonth())
            ->get();
        $cahrts['weights'] = $data->pluck('weight')->toArray();
        $cahrts['daily_cup_count'] = $data->pluck('daily_cup_count')->toArray();
        $cahrts['walk_duration'] = $data->pluck('walk_duration')->toArray();
        $cahrts['sleepHours'] = $data->pluck('sleep_hours')->toArray();
        $cahrts['days'] = $data->pluck('title')->toArray();

        return view('admin.users.statistics', compact('cahrts'));
    }
}
