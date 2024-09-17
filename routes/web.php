<?php

use App\Http\Controllers\PomodoroController;
use Illuminate\Support\Facades\Route;


Route::controller(PomodoroController::class)->group(function(){
    Route::get('/', 'index');
});