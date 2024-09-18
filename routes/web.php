<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PomodoroController;
use App\Http\Middleware\isAuthenticate;
use Illuminate\Support\Facades\Route;


Route::controller(PomodoroController::class)->group(function(){
    Route::get('/', 'index')->name('home');
});



Route::controller(AuthController::class)
->withoutMiddleware([isAuthenticate::class])
->group(function(){
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/register', 'register')->name('register');
    Route::post('/user-resgister', 'userRegister')->name('userresgister');
});