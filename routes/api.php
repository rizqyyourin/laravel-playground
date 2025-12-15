<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\TutorialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{slug}', [CategoryController::class, 'show']);

Route::get('/packages', [PackageController::class, 'index']);
Route::get('/packages/{slug}', [PackageController::class, 'show']);

Route::get('/tutorials', [TutorialController::class, 'index']);
Route::get('/tutorials/{slug}', [TutorialController::class, 'show']);

// Protected routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Package management
    Route::post('/packages', [PackageController::class, 'store']);
    Route::put('/packages/{slug}', [PackageController::class, 'update']);
    Route::delete('/packages/{slug}', [PackageController::class, 'destroy']);

    // Tutorial management
    Route::post('/tutorials', [TutorialController::class, 'store']);
    Route::put('/tutorials/{slug}', [TutorialController::class, 'update']);
    Route::delete('/tutorials/{slug}', [TutorialController::class, 'destroy']);
});
