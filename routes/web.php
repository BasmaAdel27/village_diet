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
                'middleware' => ['auth','role:admin'],
          ], function () {
              require('web/admin.php');
          });

          Route::group([
                'as' => 'trainer.',
                'prefix' => 'trainer',
                'middleware' => ['auth','role:trainer'],
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

Route::get('test_notification/{token}', function ($token) {
    return send_notification([$token], 'You get a new message','Village Diet','test');
});
