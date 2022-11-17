<?php

use App\Http\Controllers\Trainer\HomeController;
use App\Http\Controllers\Trainer\ProfileController;
use App\Http\Controllers\Trainer\SocietyController;
use App\Http\Controllers\Trainer\UserController;
use Illuminate\Support\Facades\Route;

Route::get('users_messages/{userId}', [UserController::class, 'messages'])->name('users.messages');
Route::post('send_messages/{userId}', [UserController::class, 'sendMessage'])->name('users.send_message');
Route::post('audio_message', [UserController::class, 'audioMessage'])->name('users.audio_message');
Route::get('societies/messages/{society}', [\App\Http\Controllers\Admin\SocietyController::class, 'messages'])->name('societies.messages');

Route::get('dashboard', [HomeController::class, 'home'])->name('dashboard');
Route::get('users-charts/{user}', [UserController::class, 'statistics'])->name('users.statistics');
Route::resource('users', UserController::class)->only(['index', 'show']);
Route::resource('societies', SocietyController::class)->only(['index', 'show']);
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
