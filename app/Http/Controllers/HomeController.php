<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        if ($user->isSuperAdmin() || empty(array_intersect(
            $user->roles()->pluck('name')->toArray(),
            ['user', 'trainer']
        ))) {
            return redirect()->route('admin.dashboard');
        } elseif (in_array('trainer', $user->roles()->pluck('name')->toArray())) {
            return redirect()->route('trainer.dashboard');
        }
    }
}
