<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\HealthDataController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\PersonalInfoController;
use App\Http\Controllers\Api\SubscriptionsController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\RateController;
use App\Http\Controllers\Api\AgendaController;
use App\Http\Controllers\Api\ChatController;
use Illuminate\Support\Facades\Route;

Route::middleware('GrahamCampbell\Throttle\Http\Middleware\ThrottleMiddleware:3,1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
});

Route::post('contact_us', [ContactUsController::class, 'contactUs']);
Route::get('contact_info', [ContactUsController::class, 'contactInfo']);

Route::middleware(['auth:sanctum', 'appLocale'])->group(function () {
    Route::post('update_profile', [AuthController::class, 'updateProfile']);
    Route::get('personal_info', [PersonalInfoController::class, 'personalInfo']);
    Route::get('subscriptions', [SubscriptionsController::class, 'subscriptions']);
    Route::post('cancel_subscription', [SubscriptionsController::class, 'cancelSubscription']);
    Route::resource('notifications', NotificationController::class)->only(['index', 'show']);
    Route::get('home', [HomeController::class, 'index']);
    Route::post('user_info', [HomeController::class, 'store']);
    Route::get('healthy_information', [HealthDataController::class, 'index']);
    Route::get('menu', [MenuController::class, 'index']);
    Route::get('agendaDate', [AgendaController::class, 'agendaDate']);
    Route::get('agenda/{day_id}', [AgendaController::class, 'agenda']);
    Route::controller(RateController::class)->group(function () {
        Route::get('get_rate', 'index');
        Route::post('rate', 'store');
    });

    Route::controller(ChatController::class)->group(function () {
        Route::get('get_trainer_messages', 'getTrainerMessages');
        Route::get('get_admin_messages', 'getAdminMessages');
        Route::get('get_society_messages', 'getSocietyMessages');
    });
});
