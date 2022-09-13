<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\RatingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SocietyController;
use App\Http\Controllers\Admin\StaticPageController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\MealController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\TrainerController;
use App\Http\Controllers\Admin\PendingTrainerController;
use \App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [HomeController::class,'home'])->name('dashboard');
Route::get('/users/list', [UserController::class, 'getUsers']);
Route::get('users-charts/{user}', [UserController::class, 'statistics'])->name('users.statistics');
Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class)->except('show');
Route::resource('societies', SocietyController::class)->except('show');
Route::resource('admins', AdminController::class)->except('show');
Route::resource('contactUs', ContactUsController::class)->only(['index', 'destroy', 'show']);
Route::resource('sliders', SliderController::class)->except('show');
Route::resource('static_pages', StaticPageController::class)->except('show');
Route::resource('videos', VideoController::class)->except('show');
Route::get('ratings', RatingController::class)->name('ratings.index');
Route::resource('settings', SettingController::class)->only('index', 'update');
Route::resource('meals', MealController::class)->except('show');
Route::resource('trainers', TrainerController::class)->except('show');
Route::resource('pendingTrainers', PendingTrainerController::class)->except('show','destroy','store');
Route::resource('coupons', CouponController::class)->except('show');


Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');

#region reports
Route::get('subscriptions_report', [ReportController::class, 'subscriptionsReport'])->name('reports.subscriptions');
Route::get('users_report', [ReportController::class, 'usersReport'])->name('reports.users');
Route::get('trainers_report', [ReportController::class, 'trainersReport'])->name('reports.trainers');
Route::get('copouns_report', [ReportController::class, 'copounsReport'])->name('reports.copouns');
#endregion reports
