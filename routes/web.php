<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('index')->middleware('auth');

Route::get('/register', [RegisterController::class, 'showForm'])->name('showRegisterForm');
Route::post('/register', [RegisterController::class, 'createUser'])->name('register');

Route::get('/login', [LoginController::class, 'showForm'])->name('showLoginForm');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
