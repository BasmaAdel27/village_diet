<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\CustomerOpinion;
use Illuminate\Http\Request;

class CustomerOpinionController extends Controller
{

    public function index()
    {
        $opinions=CustomerOpinion::get();
        return view('website.pages.opinions',compact('opinions'));
    }

}
