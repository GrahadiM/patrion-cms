<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LogUserActivity;
use App\Http\Controllers\API\SearchController;
use App\Http\Controllers\API\ProgramController;
use App\Http\Controllers\API\CharacterController;

Route::middleware(['api', LogUserActivity::class])->group(function () {
    // Route::get('/user', function (Request $request) {
    //     return $request->user();
    // })->middleware('auth:sanctum');

    Route::prefix('v1')->group(function () {
        Route::prefix('public')->group(function () {
            // CHARACTERS
            Route::get('/characters', [CharacterController::class, 'index']);
            Route::get('/characters/{slug}', [CharacterController::class, 'show']);
            Route::get('/characters/status/{status}', [CharacterController::class, 'filterByStatus']);

            // PROGRAMS
            Route::get('/programs', [ProgramController::class, 'index']);
            Route::get('/programs/{slug}', [ProgramController::class, 'show']);
            Route::get('/programs/status/{status}', [ProgramController::class, 'filterByStatus']);

            // SEARCH GLOBAL
            Route::get('/search', [SearchController::class, 'search']);
        });
    });
});
