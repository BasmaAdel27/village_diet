<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\TrainarController;

Route::view('/', 'website.pages.landing');
Route::view('/faqs', 'website.pages.faq');
Route::view('/meals', 'website.pages.meals');
Route::view('/opinions', 'website.pages.opinions');
Route::view('/contact', 'website.pages.contact');


//trainers
Route::get('/trainers',[TrainarController::class,'index'])->name('trainers.index');
