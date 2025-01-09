<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentDetailsController;
use App\Http\Controllers\TrackController;
use Illuminate\Support\Facades\Route;

/*
|-------------------------------------------------------------------------- 
| Web Routes
|-------------------------------------------------------------------------- 
|
| Here is where you can register web routes for your application. These 
| routes are loaded by the RouteServiceProvider within a group which 
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.landing');
});

Route::get('/signup', function () {
    return view('pages.loginsignup');
})->name('signup');

Route::get('/login', function () {
    return view('pages/login');
})->name('login');
Route::get('/student-dashboard', function () {
    return view('pages/studentdashboard');
})->name('student-dashboard');
Route::get('/student-forms', function () {
    return view('pages/studentformquestionair');
})->name('student-forms');
Route::get(
    "/sc-dashboard",
    function () {
        return view("pages/scdashboard");
    }
)->name("sc-dashboard");

Route::get('pages/student-dashboard', [TrackController::class, 'loanTracker']);


Route::post('/registerformdata', [RegisterController::class, 'store'])->name('registerformdata');
Route::post('/emailuniquecheck', [RegisterController::class, 'emailUniqueCheck'])->name('emailUniqueCheck');
// Route::post('/updateuserids', [RegisterController::class, 'updateUserIds'])->name('updateUserIds');
Route::post('/loginformdata', [LoginController::class, 'loginFormData'])->name('loginformdata');
Route::post('/update-personalinfo', [StudentDetailsController::class, 'updatePersonalInfo']);
Route::post('/update-courseinfo', [StudentDetailsController::class, 'updateCourseInfo']);
Route::post('/update-academicsinfo', [StudentDetailsController::class, 'updateAcademicsInfo']);
Route::post('/updatedetailsinfo', [StudentDetailsController::class, 'updateUserIds']);
Route::post("/coborrowerData", [StudentDetailsController::class, 'updateCoborrowerInfo']);



Route::post('/send-email', [MailController::class, 'sendEmail']);
Route::post('/verify-otp', [MailController::class, 'verifyOTP']);
Route::get('/student-dashboard', [StudentDashboardController::class, 'getUser'])->name('student-dashboard');
// Route::get('/sc-dashboard', [scdashboardco::class, 'getUser'])->name('student-dashboard');
Route::post('/from-profileupdate', [StudentDashboardController::class, 'updateFromProfile']);
Route::post('/upload-profile-picture', [StudentDashboardController::class, 'uploadProfilePicture']);
Route::post('/retrieve-profile-picture', [StudentDashboardController::class, 'retrieveProfilePicture']);
Route::post('/retrieve-pan-card', [StudentDashboardController::class, 'panCardView']);
Route::post('/session-logout', [LoginController::class, 'sessionLogout'])->name('session.logout');
Route::post('/retrieve-aadhar-card', [StudentDashboardController::class, 'aadharCardView']);
Route::post('/retrieve-passport', [StudentDashboardController::class, 'passportView']);
Route::post('/retrieve-sslcmarksheet', [StudentDashboardController::class, 'sslcmarksheetView']);
Route::post('/retrieve-hscmarksheet', [StudentDashboardController::class, 'hscmarksheetView']);
Route::post('/retrieve-graduationmarksheet', [StudentDashboardController::class, 'graduationmarksheetView']);
Route::post('/upload-each-documents', [StudentDashboardController::class, 'uploadMultipleDocuments']);
Route::post('/count-documents', [StudentDashboardController::class, 'countFilesInBucket']);
Route::post('/check-columns', [StudentDashboardController::class, 'validateTablesAndColumns']);
Route::post('/send-documents', [MailController::class, 'sendUserDocuments']);

Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);