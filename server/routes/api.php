<?php

use App\Http\Controllers\v1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



//Unauthenticated Routes
// Route::group(['prefix' => 'guest'], function(){
//     Route::post('/login', [AuthController::class, 'login']);
//     Route::post('/signup', [AuthController::class, 'signup'])
// })



//Unauthenticated Routes
Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'guest'], function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/signup', [AuthController::class, 'signup']);
    });
});
