<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContactUsController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('contact_us', [ContactUsController::class, 'contactUs']);

Route::middleware('auth:sanctum')->group(function () {
});
