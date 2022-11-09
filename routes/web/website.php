<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'website.pages.landing');
Route::view('/faqs', 'website.pages.faq');
Route::view('/meals', 'website.pages.meals');
Route::view('/trainers', 'website.pages.trainers');
Route::view('/opinions', 'website.pages.opinions');
Route::view('/contact', 'website.pages.contact');
