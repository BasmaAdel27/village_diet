<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use Illuminate\Http\Request;

class TrainarController extends Controller
{

    public function index()
    {
        $trainers=Trainer::where('show_inPage',1)->with('user')->get();

        return view('website.pages.trainers',compact('trainers'));
    }

}
