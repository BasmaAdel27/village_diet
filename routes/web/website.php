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
    Route::post('renew_subscription', 'reactivateSubscription')->name('renew');
    Route::get('form/{user}', 'getHealthyForm')->name('healthy.form');
    Route::post('store-form/{user}/{survey}', 'storeHealthyForm')->name('healthy.store');
    Route::get('payment/{user}', 'getPayment')->name('payment.form');
    Route::post('payment/{user}', 'storePayment')->name('payment.store');
});

//trainers
Route::get('/trainers', [TrainarController::class, 'index'])->name('trainers.index');
//contactus
Route::resource('/contact_us', ContactUsController::class);
//customer opinions
Route::get('/customers_opinions', [CustomerOpinionController::class, 'index'])->name('customers_opinions.index');


Route::post('subscribe', [SubscribeController::class, 'subscribe'])->name('subscribe');
Route::get('static_pages/{staticPage}', function (StaticPage $staticPage) {
    return view('website/pages/static_page', ['staticPage' => $staticPage]);
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

Route::get('register_trainer/create', [TrainarController::class, 'create'])->name('register_trainer.create');
Route::post('register_trainer/store', [TrainarController::class, 'store'])->name('register_trainer.store');
Route::get('callback/{user}/{code?}', [\App\Http\Controllers\MyFatoorahController::class, 'callback'])->name('callback');


Route::get('send-mail', function () {
    Mail::to('m.karem456@gmail.com')->send(new \App\Mail\UserNumber());
    return 'A message has been sent!';
});
