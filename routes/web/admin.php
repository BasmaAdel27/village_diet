<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::view('dashboard', 'admin.app')->name('dashboard');
Route::get('/users/list', [UserController::class, 'getUsers'])->name('users.list');

Route::resource('users', UserController::class);
Route::resource('admins', AdminController::class);
