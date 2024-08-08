<?php

use App\Http\Controllers\ManajerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// routes/api.php
Route::get('/user-stats', [ManajerController::class, 'getUserStats'])->name('api.user-stats');
