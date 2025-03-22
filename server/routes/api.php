<?php

use App\Http\Controllers\v1\AuthController;
use App\Http\Controllers\v1\User\SnippetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::group(['prefix' => 'v1'], function () {
    Route::group(["middleware" => "auth:api"], function () {
        Route::group(['prefix' => 'user'], function () {
            Route::get('/getSnippets', [SnippetController::class, 'getSnippets']);
            Route::post('/addSnippet', [SnippetController::class, 'addSnippet']);
            Route::post('/updateSnippet', [SnippetController::class, 'updateSnippet']);
            Route::post('/deleteSnippet', [SnippetController::class, 'deleteSnippet']);
        });
    });


    //Unauthenticated Routes
    Route::group(['prefix' => 'guest'], function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/signup', [AuthController::class, 'signup']);
    });
});
