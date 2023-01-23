<?php

use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Api\{
    AuthController,
    ContactUsController,
    HealthDataController,
    HomeController,
    MenuController,
    PersonalInfoController,
    SubscriptionsController,
    NotificationController,
    RateController,
    AgendaController,
    ChatController,
    SocietyController
};
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::middleware('GrahamCampbell\Throttle\Http\Middleware\ThrottleMiddleware:3,1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
});
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout',   [AuthController::class, 'logout']);
});
Route::post('contact_us', [ContactUsController::class, 'contactUs']);
Route::get('contact_info', [ContactUsController::class, 'contactInfo']);
Route::get('static_page/{id}', [MenuController::class, 'show']);

Route::middleware(['auth:sanctum', 'appLocale', \App\Http\Middleware\InActiveStatus::class])->group(function () {
    Route::post('update_user_add_firebase', [AuthController::class, 'addFirebaseToUser']);
    Route::post('update_profile', [AuthController::class, 'updateProfile']);
    Route::delete('delete_account', [AuthController::class, 'DeleteAccount']);
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
    Route::get('society_status', [SocietyController::class, 'societyStatus']);

    Route::controller(ChatController::class)->group(function () {
        Route::get('get_trainer_messages', 'getTrainerMessages');
        Route::get('get_admin_messages', 'getAdminMessages');
        Route::get('get_society_messages', 'getSocietyMessages');
        Route::post('store_messages', 'storeTrainerMessages');
        Route::post('store_admin_messages', 'storeAdminMessages');
        Route::post('store_society_messages', 'storeSocietyMessages');
        Route::delete('destroy_trainer_message/{message_id}', 'destroyMsgTrainer');
        Route::delete('destroy_admin_message/{message_id}', 'destroyMsgAdmin');
        Route::delete('destroy_society_message/{message_id}', 'destroyMsgSociety');
    });
});

Route::get('/states', [AjaxController::class, 'fetchState'])->name('admin.states');
