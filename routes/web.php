<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes([
    'register' => false,
    'verify' => false,
]);
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::group([
            'as' => 'admin.',
            'prefix' => 'admin',
            'middleware' => ['auth'],
        ], function () {
            require('web/admin.php');
        });

        Route::group([
            'as' => 'trainer.',
            'prefix' => 'trainer',
            'middleware' => ['auth'],
        ], function () {
            require('web/trainer.php');
        });

        Route::group([
            'as' => 'website.',
        ], function () {
            require('web/website.php');
        });
    }
);

Route::get('send_notitfy', function () {
    send_notification('deq0yF1tQx6SmaZ3c2kYWP:APA91bGr3Bb3EkgN5D4C_sqnp0ICclF1d7ERVAPTtQO2_dZ7fzmS2GuA1aSAy5Yb9crsHFr81fd83bO3D1u2oYOGH-8OGk7iKaVQ2ZhOwccx4zvFIH9-pIGvPpPpF2kuR8JIaLNApW2p', ['name' => 'ازيك ي عودة'], 'New Message', 'Hello World Test Notification');
});
