<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;  // Ensure LoginController is imported
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------|
| API Routes                                                              |
|--------------------------------------------------------------------------|
| Here is where you can register API routes for your application. These    |
| routes are loaded by the RouteServiceProvider within a group which       |
| is assigned the "api" middleware group. Enjoy building your API!         |
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json($request->user());
});

// User registration route
Route::post('/registeruser', [RegisterController::class, 'register']);

// Optionally, show a message (this can be removed if not needed)
Route::get('/registeruser', [RegisterController::class, 'showMessage']);

// Login route (ensure LoginController is imported)
Route::post('/loginformdata', [LoginController::class, 'loginFormData'])->name('loginformdata');
