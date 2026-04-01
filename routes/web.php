<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProfileController::class, 'index']);
Route::post('/profile/update-photo', [ProfileController::class, 'updatePhoto']);

Route::get('/projects', [ProjectController::class, 'index']);
Route::post('/projects/store', [ProjectController::class, 'store']);
Route::post('/projects/update/{id}', [ProjectController::class, 'update']);
Route::delete('/projects/delete/{id}', [ProjectController::class, 'destroy']);
