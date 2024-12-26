<?php

use App\Http\Controllers\Auth\RegisterController;
<<<<<<< HEAD
use App\Http\Controllers\Auth\LoginController; // Include LoginController
=======
use App\Http\Controllers\LoginController;
>>>>>>> f3dd1813f1d1718939807a78ed42c3698735d6b4
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
Route::post('/retrieve-profile-picture', [StudentDashboardController::class, 'retrieveProfilePicture']);
Route::post('/retrieve-pan-card', [StudentDashboardController::class, 'panCardView']);
Route::post('/retrieve-aadhar-card', [StudentDashboardController::class, 'aadharCardView']);
Route::post('/loginformdata', [LoginController::class, 'loginFormData'])->name('loginformdata');
Route::post('/count-documents', [StudentDashboardController::class, 'countFilesInBucket']);
Route::post('/from-profileupdate', [StudentDashboardController::class, 'updateFromProfile']);

// User Registration
Route::post('/registeruser', [RegisterController::class, 'register']);
Route::get('/registeruser', [RegisterController::class, 'showMessage']);

// User Login
Route::post('/loginformdata', [LoginController::class, 'loginFormData'])->name('loginformdata');

// Example of a Student Dashboard route (uncomment and modify if needed)
// Route::get('/dashboard', [StudentDashboardController::class, 'index']);
