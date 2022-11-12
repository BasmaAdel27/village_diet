<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\TrainarController;
use App\Http\Controllers\Website\ContactUsController;
use App\Http\Controllers\Website\CustomerOpinionController;

Route::view('/', 'website.pages.landing');
Route::view('/faqs', 'website.pages.faq');
Route::view('/meals', 'website.pages.meals');



//trainers
Route::get('/trainers',[TrainarController::class,'index'])->name('trainers.index');
//contactus
Route::resource('/contact_us', ContactUsController::class);
//customer opinions
Route::get('/customers_opinions',[CustomerOpinionController::class,'index'])->name('customers_opinions.index');


