<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user',[UserController::class, 'index']);

// Route::get('/test', function (Request $request) {   
//     return "Hello World";
// });

Route::group([
    'prefix' => 'auth'
],
    function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);

        Route::group([
            'middleware' => 'auth:sanctum'
        ], function () {
            Route::get('logout', [AuthController::class, 'logout']);
            Route::get('user', [AuthController::class, 'user']);
        });
    }
);

Route::post('/add', [ItemController::class, 'store']);
Route::get('/items', [ItemController::class, 'get']);

