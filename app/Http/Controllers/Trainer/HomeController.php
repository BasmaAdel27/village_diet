<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Society\Society;
use App\Models\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:trainer.dashboard')->only(['home']);
    }

    public function home()
    {
        $users = User::whereHas('roles', fn ($q) => $q->where('name', 'user'))
            ->whereHas('society', fn ($q) => $q->where('trainer_id', auth()->id()))
            ->count();
        $societies = Society::where('trainer_id', auth()->id())->count();

        return view('trainer.dashboard', compact('users', 'societies'));
    }
}
