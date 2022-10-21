<?php

namespace App\Http\Controllers\Trainer;

use App\DataTables\Trainer\UserDatatable;
use App\Http\Controllers\Controller;
use App\Models\HealthyInformation;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:trainer.users.index')->only(['index']);
        $this->middleware('permission:trainer.users.statistics')->only(['statistics']);
    }

    public function index(UserDatatable $userDatatable)
    {
        return $userDatatable->render('trainer.users.index');
    }

    public function show(User $user)
    {
        return view('trainer.users.show', compact('user'));
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

        return view('trainer.users.statistics', compact('cahrts'));
    }

    public function messages()
    {
        return view('trainer.users.messages');
    }
}
