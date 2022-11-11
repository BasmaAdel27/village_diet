<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\ContactUsRequest;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{

    public function index()
    {
        return view('website.pages.contact');
    }


    public function store(ContactUsRequest $request,ContactUs $contactUs)
    {
        $data=$request->validated();
        $contactUs->fill($data)->save();
        return redirect()->back()->with('success', trans('created_successfully'));


    }


}
