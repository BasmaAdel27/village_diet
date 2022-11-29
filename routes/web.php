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

Route::get('test_notification/{token}', function ($token) {
    return send_notification([$token], [
          'title' => 'village_diet',
          'title_ar' => 'فيليج دايت',
          'body' => 'test notification',
          'body_ar' => 'اشعار تجريبي',
    ],'Village Diet','New Message');
});
