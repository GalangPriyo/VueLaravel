<?php

use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AbleCreateOrder;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/me', [AuthController::class, 'me'])->middleware(['auth:sanctum']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/create-order', function () {
        return 'create order';
    })->middleware(AbleCreateOrder::class);

    Route::post('/finish-order', function () {
        return 'finish order';
    })->middleware('ableFinishOrder');

    Route::post('/user', [UserController::class, 'store'])->middleware(['ableCreateUser']);
});
