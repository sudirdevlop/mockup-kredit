<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductCategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\OjkDataController;
use App\Http\Controllers\Api\YoutubeVideoController;
use App\Http\Controllers\Api\CreditSimulationController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public product routes
Route::get('/product-categories', [ProductCategoryController::class, 'index']);
Route::get('/product-categories/{id}', [ProductCategoryController::class, 'show']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);

// Public article routes
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{id}', [ArticleController::class, 'show']);

// Public OJK data routes
Route::get('/ojk-data', [OjkDataController::class, 'index']);
Route::get('/ojk-data/{id}', [OjkDataController::class, 'show']);

// Public YouTube video routes
Route::get('/youtube-videos', [YoutubeVideoController::class, 'index']);
Route::get('/youtube-videos/{id}', [YoutubeVideoController::class, 'show']);

// Public credit simulation calculator
Route::post('/credit-simulations/calculate', [CreditSimulationController::class, 'calculate']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Product categories (admin only - implement middleware later)
    Route::post('/product-categories', [ProductCategoryController::class, 'store']);
    Route::put('/product-categories/{id}', [ProductCategoryController::class, 'update']);
    Route::delete('/product-categories/{id}', [ProductCategoryController::class, 'destroy']);

    // Products (admin only - implement middleware later)
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    // Applications
    Route::apiResource('applications', ApplicationController::class);

    // Articles (admin only for create, update, delete)
    Route::post('/articles', [ArticleController::class, 'store']);
    Route::put('/articles/{id}', [ArticleController::class, 'update']);
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);

    // OJK data (admin only)
    Route::post('/ojk-data', [OjkDataController::class, 'store']);
    Route::put('/ojk-data/{id}', [OjkDataController::class, 'update']);
    Route::delete('/ojk-data/{id}', [OjkDataController::class, 'destroy']);

    // YouTube videos (admin only)
    Route::post('/youtube-videos', [YoutubeVideoController::class, 'store']);
    Route::put('/youtube-videos/{id}', [YoutubeVideoController::class, 'update']);
    Route::delete('/youtube-videos/{id}', [YoutubeVideoController::class, 'destroy']);

    // Credit simulations
    Route::get('/credit-simulations', [CreditSimulationController::class, 'index']);
    Route::post('/credit-simulations', [CreditSimulationController::class, 'store']);
    Route::get('/credit-simulations/{id}', [CreditSimulationController::class, 'show']);
    Route::delete('/credit-simulations/{id}', [CreditSimulationController::class, 'destroy']);
});
