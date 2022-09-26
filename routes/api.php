<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\PersonalInfoController;
use App\Http\Controllers\Api\SubscriptionsController;
use App\Http\Controllers\Api\NotificationController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('contact_us', [ContactUsController::class, 'contactUs']);
Route::get('contact_info', [ContactUsController::class, 'contactInfo']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('personal_info', [PersonalInfoController::class, 'personalInfo']);
    Route::get('subscriptions', [SubscriptionsController::class, 'subscriptions']);
    Route::post('cancel_subscription/{id}', [SubscriptionsController::class, 'cancelSubscription']);
    Route::resource('notifications', NotificationController::class)->only(['index', 'show']);
    Route::get('home', [HomeController::class, 'index']);
    Route::post('user_info', [HomeController::class, 'store']);
});
