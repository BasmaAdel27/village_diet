<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $users=User::all()->count();
        $trainers=Trainer::all()->count();
        $trainers_pending=Trainer::where('status','PENDING')->get()->count();
//        dd($users);

        return view('admin.dashboard',compact('users','trainers','trainers_pending'));
    }
}
