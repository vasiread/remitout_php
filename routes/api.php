<?php

use App\Http\Controllers\ExportController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OTPMobController;
use App\Http\Controllers\scDashboardController;
use App\Http\Controllers\SidebarHandlingController;
use App\Http\Controllers\StudentCounsellorController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/retrieve-profile-picture', [StudentDashboardController::class, 'retrieveProfilePicture']);
Route::post('/retrieve-pan-card', [StudentDashboardController::class, 'panCardView']);
Route::post('/retrieve-aadhar-card', [StudentDashboardController::class, 'aadharCardView']);
Route::post('/loginformdata', [LoginController::class, 'loginFormData'])->name('loginformdata');
Route::post('/count-documents', [StudentDashboardController::class, 'countFilesInBucket']);
Route::post('/from-profileupdate', [StudentDashboardController::class, 'updateFromProfile']);
Route::post('/check-columns', [StudentDashboardController::class, 'validateTablesAndColumns']);
Route::post('/send-documents', [MailController::class, 'sendUserDocuments']);
// Route::post('/registeruser', [RegisterController::class, 'register']);
Route::post('/send-mobotp', [OTPMobController::class, 'sendOTP']);
Route::post('/verify-mobotp', [OTPMobController::class, 'verifyOTP']);
Route::post('/emailuniquecheck', action: [RegisterController::class, 'emailUniqueCheck']);

// Route::get('/registeruser', [RegisterController::class, 'showMessage']);

Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);
Route::get("/getalluserdetailsfromadmin", [StudentDashboardController::class, 'getAllUsersFromAdmin']);
Route::post('/retrieve-file', action: [StudentDashboardController::class, 'retrieveFile']);
Route::post('/remove-each-documents', [StudentDashboardController::class, 'removeFromServer']);
// routes/web.php
Route::post('/getuserbyref', [scDashboardController::class, 'getUsersByCounsellorApi']);


Route::post("/register-studentcounsellor", [scDashboardController::class, 'uploadScUserInfo']);