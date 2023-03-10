<?php

use App\Http\Controllers\Admin\{
    AdminController,
    UserController,
    RoleController,
    ContactUsController,
    RatingController,
    SliderController,
    SocietyController,
    StaticPageController,
    VideoController,
    SettingController,
    ProfileController,
    MealController,
    NotiifcationController,
    ReportController,
    TrainerController,
    PendingTrainerController,
    CouponController,
    HomeController,
    PostelNewsController,
    TemplateController,
    CustomerOpinionController,
    ServiceController,
    SubscriptionController,
    FaqsController,
    CountryController
};
use Illuminate\Support\Facades\Route;

Route::get('societies/messages/{society}', [SocietyController::class, 'messages'])->name('societies.messages');
Route::post('societies/addMsg', [SocietyController::class, 'addMsg'])->name('societies.addMsg');
Route::post('societies/save', [SocietyController::class, 'save'])->name('societies.save');
Route::post('users/chat/{id}', [UserController::class, 'sendMessage'])->name('users.send_message');
Route::get('users/messages/{id}', [UserController::class, 'messages'])->name('users.messages');
Route::post('audio_save', [UserController::class, 'audioSave'])->name('users.audio_save');

Route::get('dashboard', [HomeController::class, 'home'])->name('dashboard');
Route::get('users-form-data', [UserController::class, 'getFormData'])->name('users.form_data');
Route::post('users-form-data/{survey}', [UserController::class, 'postFormData'])->name('users.post_data');
Route::get('users-charts/{user}', [UserController::class, 'statistics'])->name('users.statistics');
Route::post('pending-trainers/submit/{id}', [PendingTrainerController::class, 'submit'])->name('pending-trainers.submit');
Route::post('pending-trainers/declined/{id}', [PendingTrainerController::class, 'declined'])->name('pending-trainers.declined');

Route::resource('users', UserController::class);
Route::resource('notifications', NotiifcationController::class)->except(['edit', 'update', 'show']);
Route::resource('roles', RoleController::class)->except('show');
Route::resource('societies', SocietyController::class)->except('show');
Route::resource('admins', AdminController::class)->except('show');
Route::resource('contactUs', ContactUsController::class)->only(['index', 'destroy', 'show']);
Route::resource('sliders', SliderController::class)->except('show');
Route::resource('static_pages', StaticPageController::class)->except('show');
Route::resource('videos', VideoController::class)->except('show');
Route::get('ratings', RatingController::class)->name('ratings.index');
Route::resource('settings', SettingController::class)->only('index', 'update');
Route::resource('meals', MealController::class);
Route::resource('trainers', TrainerController::class)->except('show');
Route::resource('pending-trainers', PendingTrainerController::class)->only('index', 'edit');
Route::resource('coupons', CouponController::class)->except('show');
Route::resource('postel_news', PostelNewsController::class)->except(['show', 'update', 'edit']);


Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');

#region reports
Route::get('subscriptions-report', [ReportController::class, 'subscriptionsReport'])->name('reports.subscriptions');
Route::get('users-report', [ReportController::class, 'usersReport'])->name('reports.users');
Route::get('trainers-report', [ReportController::class, 'trainersReport'])->name('reports.trainers');
Route::get('copouns-report', [ReportController::class, 'copounsReport'])->name('reports.copouns');
#endregion reports

Route::resource('templates', TemplateController::class)->except('show');
Route::resource('opinions', CustomerOpinionController::class);
Route::get('subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
Route::put('subscriptions/active/{id}', [SubscriptionController::class, 'active'])->name('subscriptions.active');
Route::put('subscriptions/inactive/{id}', [SubscriptionController::class, 'inactive'])->name('subscriptions.inactive');
Route::resource('services', ServiceController::class)->except('show');
Route::post('services/show', [ServiceController::class, 'showSection'])->name('services.show');
Route::post('services/disable', [ServiceController::class, 'disableSection'])->name('services.disable');
Route::resource('common_questions', FaqsController::class);
Route::resource('countries', CountryController::class)->except('show');
