<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('home');
});


Route::get('/students', [StudentController::class, 'index']);
Route::get('/', [HomeController::class, 'index']);