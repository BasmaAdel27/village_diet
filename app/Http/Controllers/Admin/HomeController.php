<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use App\Models\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin.dashboard')->only(['home']);
    }

    public function home()
    {
        $users = User::count();
        $trainers = Trainer::count();
        $trainers_pending = Trainer::where('status', 'PENDING')->count();

        return view('admin.dashboard', compact('users', 'trainers', 'trainers_pending'));
    }
}
