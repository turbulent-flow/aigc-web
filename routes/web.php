<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showForm']);
Route::get('/register', [RegisterController::class, 'showForm']);
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');

Route::resource('users', UserController::class)->only(['store']);
