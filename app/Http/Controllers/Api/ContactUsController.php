<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactUsRequest;
use App\Http\Resources\Api\ContactInfoResource;
use App\Http\Resources\Api\ContactUsResource;
use App\Models\ContactUs;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class ContactUsController extends Controller
{
    public function ContactUs(ContactUsRequest $contactUsRequest){
          $data=$contactUsRequest->validated();
          $contactUs=ContactUs::create([
                'message_type'=>$data['message_type'],
                'content'=>$data['content'],
          ]);


          return successResponse(ContactUsResource::make($contactUs),extra: ['message' => Lang::get('message_has_been_sent_successfully')]);
    }


    public function contactInfo(){
        $info=Setting::first();
        return successResponse(ContactInfoResource::make($info));
    }
}
