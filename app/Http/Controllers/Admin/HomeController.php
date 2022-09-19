<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
        $subscriptions=Subscription::groupBy('date')
          ->orderBy('date', 'asc')
          ->get([
                DB::raw('MONTH(created_at) as date'),
                DB::raw('count(id) as total')
          ])
          ;
        $charts['months']=$subscriptions->pluck('date')->toArray();
        $charts['Subscriptions']=$subscriptions->pluck('total')->toArray();

        return view('admin.dashboard', compact('charts','users', 'trainers', 'trainers_pending'));
    }


}
