<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'admin.app');
Route::get('/users/list',[UserController::class,'getUsers'])->name('users.list');

Route::resource('users', UserController::class,['names' => [
      'index' => 'users.index',
      'store' => 'users.store',
      'edit'=>'users.edit',
      'update'=>'users.update',
      'show'=>'users.show',
      'destroy'=>'users.delete',
      'create'=>'users.create'
]]);
Route::get('/roles/list',[RoleController::class,'getRoles'])->name('roles.list');

Route::resource('permissions', RoleController::class);

