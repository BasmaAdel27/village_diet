<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;

Route::view('dashboard', 'admin.app')->name('dashboard');
Route::get('/users/list', [UserController::class, 'getUsers'])->name('users.list');

Route::resource('users', UserController::class);
Route::get('/roles/list',[RoleController::class,'getRoles'])->name('roles.list');

Route::resource('permissions', RoleController::class);
Route::resource('admins', AdminController::class);
