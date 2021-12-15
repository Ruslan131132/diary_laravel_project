<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;

Route::get('/', function() {
    return view('pages.index');
})->name('index');

Route::get('/logout', function(){
    Auth::logout();
    return redirect(route('index'));
})->name('logout');

Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');

Route::name('user.')->group(function(){
    Route::view('/user',  'pages.user.user-main')->middleware('auth')->name('user-main');
});

Route::name('admin.')->group(function(){
    Route::view('/admin-main', 'pages.admin.main')->middleware('auth')->middleware('admin')->name('main');
    Route::get('/admin-users', [\App\Http\Controllers\Admin\UsersController::class, 'index'])->middleware('auth')->middleware('admin')->name('users');
    Route::view('/admin-classes',  'pages.admin.classes')->middleware('auth')->middleware('admin')->name('classes');
    Route::view('/admin-subjects',  'pages.admin.subjects')->middleware('auth')->middleware('admin')->name('subjects');
    Route::view('/admin-employment',  'pages.admin.employment')->middleware('auth')->middleware('admin')->name('employment');
    Route::view('/admin-schedule',  'pages.admin.schedule')->middleware('auth')->middleware('admin')->name('schedule');

    Route::post('/create-user', [\App\Http\Controllers\Admin\UsersController::class, 'save'])->name('create-user');
    Route::post('/delete-user', [\App\Http\Controllers\Admin\UsersController::class, 'delete'])->name('delete-user');
});
