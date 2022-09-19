<?php

use App\Http\Controllers\Trainer\HomeController;
use App\Http\Controllers\Trainer\ProfileController;
use App\Http\Controllers\Trainer\SocietyController;
use App\Http\Controllers\Trainer\UserController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [HomeController::class, 'home'])->name('dashboard');
Route::get('users-charts/{user}', [UserController::class, 'statistics'])->name('users.statistics');
Route::resource('users', UserController::class)->only(['index', 'show']);
Route::resource('societies', SocietyController::class)->only(['index', 'show']);
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
