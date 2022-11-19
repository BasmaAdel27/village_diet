<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\RegisterRequest;
use App\Models\Country\Country;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        $countries = Country::listsTranslations('name')->pluck('name', 'id');

        return view('website.pages.register.register', compact('countries'));
    }

    public function store(RegisterRequest $request)
    {
        # code...
    }
}
