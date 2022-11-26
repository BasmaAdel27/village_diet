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


Route::get('test', function () {
    return send_notification(['c7y1GRrhnkbykesYvQEweW:APA91bHpSgptV61W4SkOPw0FDEEUGDwUUW2WQDu6h8LZ8MLyypdW6DQl2EDqBPGp5nSYUrpWuxHulQDMnavj-KNi8EfNYs_nTbBuZsXjI0NYa0BXwt4YpXXUEkIFllGZ1XSM3Hz2RXNO'], [
          'title' => 'Hashim',
          'title_ar' => 'Hashim',
          'body' => 'Hashim',
          'body_ar' => 'Hashim',
    ]);
});
