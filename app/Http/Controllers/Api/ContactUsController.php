<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactUsRequest;
use App\Http\Resources\Api\ContactUsResource;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function ContactUs(ContactUsRequest $contactUsRequest){
          $data=$contactUsRequest->validated();
          $contactUs=ContactUs::create([
                'message_type'=>$data['message_type'],
                'content'=>$data['content'],
                'user_type'=>'user'
          ]);

          return successResponse(ContactUsResource::make($contactUs));
    }
}
