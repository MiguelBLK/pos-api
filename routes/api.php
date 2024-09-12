<?php

use App\Http\Controllers\Api\StoreTypeController;
use App\Http\Controllers\Api\StatusesController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\StoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/store-type', [StoreTypeController::class, 'index']);
Route::post('/store-type', [StoreTypeController::class, 'create']);

Route::get('/store', [StoreController::class, 'index']);
Route::post('/store', [StoreController::class, 'create']);

Route::get('/statuses', [StatusesController::class, 'index']);
Route::post('/statuses', [StatusesController::class, 'create']);

Route::get('/employees', [EmployeeController::class, 'index']);
Route::post('/employees', [EmployeeController::class, 'create']);