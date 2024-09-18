<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::middleware('')->controller(AuthController::class)->group(function(){
    Route::get('/home', 'index');
});
