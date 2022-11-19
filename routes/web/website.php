<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\{
    TrainarController,
    ContactUsController,
    CustomerOpinionController,
    HomeController,
    RegisterController,
    SubscribeController
};
use App\Models\Faq\Faq;
use App\Models\StaticPage\StaticPage;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::controller(RegisterController::class)->prefix('register')->group(function () {
    Route::get('/', 'getRegister')->name('register');
    Route::post('/', 'storeRegister')->name('register.store');
    Route::get('form/{user}', 'getHealthyForm')->name('healthy.form');
    Route::post('store-form/{user}/{survey}', 'storeHealthyForm')->name('healthy.store');
    Route::get('payment', 'getPayment')->name('payment.form');
    Route::post('payment', 'storePayment')->name('payment.store');
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
