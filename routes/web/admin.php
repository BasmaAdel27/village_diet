<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SocietyController;
use Illuminate\Support\Facades\Route;

Route::view('dashboard', 'admin.dashboard')->name('dashboard');
Route::get('/users/list', [UserController::class, 'getUsers']);

Route::resource('users', UserController::class);
Route::get('/roles/list', [RoleController::class, 'getRoles']);

Route::resource('roles', RoleController::class)->except('show');
Route::resource('societies', SocietyController::class)->except('show');
Route::resource('admins', AdminController::class)->except('show');
Route::resource('contactUs', ContactUsController::class)->only(['index', 'destroy', 'show']);
Route::resource('sliders', SliderController::class)->except('show');
