<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\TrainarController;
use App\Http\Controllers\Website\ContactUsController;
use App\Http\Controllers\Website\CustomerOpinionController;
use App\Http\Controllers\Website\SubscribeController;
use App\Models\StaticPage\StaticPage;

Route::view('/', 'website.pages.landing')->name('home');
Route::view('/faqs', 'website.pages.faq');
Route::view('/meals', 'website.pages.meals');



//trainers
Route::get('/trainers', [TrainarController::class, 'index'])->name('trainers.index');
//contactus
Route::resource('/contact_us', ContactUsController::class);
//customer opinions
Route::get('/customers_opinions', [CustomerOpinionController::class, 'index'])->name('customers_opinions.index');


Route::post('subscribe', [SubscribeController::class, 'subscribe'])->name('subscribe');
Route::get('static_pages/{id}', function (StaticPage $staticPage) {
    return view('website/static_page', ['staticPage' => $staticPage]);
})->name('static_pages.show');
