<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController; // Include LoginController
use App\Http\Controllers\StudentDashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Protected route (requires token authentication)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// User Registration
Route::post('/registeruser', [RegisterController::class, 'register']);
Route::get('/registeruser', [RegisterController::class, 'showMessage']);

// User Login
Route::post('/loginformdata', [LoginController::class, 'loginFormData'])->name('loginformdata');

// Example of a Student Dashboard route (uncomment and modify if needed)
// Route::get('/dashboard', [StudentDashboardController::class, 'index']);
