<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PersonalInfoResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class PersonalInfoController extends Controller
{
    public  function personalInfo(){
        if (Auth::user()->is_active == 1 && Auth::user()->email_verified_at != null) {
            $user = Auth::user();
            return successResponse(PersonalInfoResource::make($user));

        }
        return failedResponse(Lang::get('unauthorized'));

    }
}
