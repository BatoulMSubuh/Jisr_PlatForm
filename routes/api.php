<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/login/verify-otp', [AuthController::class, 'verifyLoginOtp']);
Route::post('/password/forgot', [AuthController::class, 'forgetPassword']);
Route::post('/password/reset', [AuthController::class, 'resetPassword']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/logout-all', [AuthController::class, 'logoutAll']);
});

// Admin
Route::middleware('auth:admin')-> prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'listUsers']);
    Route::get('/CompanyUnverified', [UserController::class, 'getUnverifiedCompanies']);

    // Route::post('/users/{id}/assign-role', [AdminController::class, 'assignRole']);
});
