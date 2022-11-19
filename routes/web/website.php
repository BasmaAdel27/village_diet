<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\TrainarController;
use App\Http\Controllers\Website\ContactUsController;
use App\Http\Controllers\Website\CustomerOpinionController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\RegisterController;
use App\Http\Controllers\Website\SubscribeController;
use App\Models\Faq\Faq;
use App\Models\StaticPage\StaticPage;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::controller(RegisterController::class)->group(function () {
    Route::get('register', 'create')->name('register');
    Route::post('register', 'create')->name('register.store');
});

Route::view('/payment', 'website.pages.register.payment');
Route::view('/form', 'website.pages.register.form');



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

Route::get('faq', function () {
    return view('website/pages/faq', ['faqs' => Faq::where('is_active', true)->get()]);
})->name('faqs');

Route::get('food_recipes', function () {
    return view(
        'website/pages/meals',
        ['page' => StaticPage::where('slug', 'Food-Recipes')->first()]
    );
})->name('food_recipes');
