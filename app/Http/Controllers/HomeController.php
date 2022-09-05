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
        if ($user->isSuperAdmin() || $user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
    }
}
