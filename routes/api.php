<?php

use App\Http\Controllers\Api\StoreTypeController;
use App\Http\Controllers\Api\StoreController;
use Illuminate\Support\Facades\Route;



Route::get('/store-type', [StoreTypeController::class, 'index']);
Route::post('/store', [StoreController::class, 'create']);