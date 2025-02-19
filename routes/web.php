<?php

use App\Http\Controllers\{
    AuthController,
    GoogleAuthController,
    LoginController,
    MailController,
    OTPMobController,
    RegisterController,
    SidebarHandlingController,
    StudentDashboardController,
    StudentDetailsController,
    TrackController
};
use App\Http\Controllers\ExportController;
use App\Http\Controllers\scDashboardController;
use App\Http\Controllers\StudentCounsellorController;
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

// Landing and Authentication Routes
Route::get('/', function () {
    return view('pages.landing');
});

Route::get('/signup', function () {
    return view('pages.loginsignup');
})->name('signup');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');
Route::get('/nbfc-dashboard', function () {
    return view('pages.nbfcdashboard');
})->name('login');


Route::get('/admin-page', function () {

    $sidebarItems = (new SidebarHandlingController)->admindashboardItems();
    $userDetails = (new StudentDashboardController)->getAllUsersFromAdmin();  // Example class name

    return view('pages.adminpage', [
        'sidebarItems' => $sidebarItems,
        'userDetails' => $userDetails,
    ]);
})->name('admin-page');
Route::get('/sc-dashboard', function () {
    $sidebarItems = (new SidebarHandlingController)->scdashboardItems();
    $userByRef = (new scDashboardController)->getUsersByCounsellor();
    return view('pages.scdashboard', [
        'sidebarItems' => $sidebarItems,
        'userByRef' => $userByRef,
    ]);
})->name('sc-dashboard');
// Student Routes
Route::get('/student-dashboard', [StudentDashboardController::class, 'getUser'])->name('student-dashboard');
Route::get('/student-forms', function () {
    return view('pages.studentformquestionair');
})->name('student-forms');


// Miscellaneous Routes
Route::get('pages/student-dashboard', [TrackController::class, 'loanTracker']);

// Google Authentication Routes
Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);

// Form Submission Routes
Route::post('/registerformdata', [RegisterController::class, 'store'])->name('registerformdata');
Route::post('/emailuniquecheck', [RegisterController::class, 'emailUniqueCheck'])->name('emailUniqueCheck');
Route::post('/loginformdata', [LoginController::class, 'loginFormData'])->name('loginformdata');
Route::post('/session-logout', [LoginController::class, 'sessionLogout'])->name('session.logout');

// Update Routes for Student Details
Route::post('/update-personalinfo', [StudentDetailsController::class, 'updatePersonalInfo']);
Route::post('/update-courseinfo', [StudentDetailsController::class, 'updateCourseInfo']);
Route::post('/update-academicsinfo', [StudentDetailsController::class, 'updateAcademicsInfo']);
Route::post('/updatedetailsinfo', [StudentDetailsController::class, 'updateUserIds']);
Route::post("/coborrowerData", [StudentDetailsController::class, 'updateCoborrowerInfo']);

// Document Upload and Handling Routes
Route::post('/remove-each-documents', [StudentDashboardController::class, 'removeFromServer']);
Route::post('/upload-each-documents', [StudentDashboardController::class, 'uploadMultipleDocuments']);
Route::post('/count-documents', [StudentDashboardController::class, 'countFilesInBucket']);
Route::post('/check-columns', [StudentDashboardController::class, 'validateTablesAndColumns']);
Route::post('/send-documents', [MailController::class, 'sendUserDocuments']);
Route::post('/retrieve-file', [StudentDashboardController::class, 'retrieveFile']);

Route::post('/getuserbyref', [scDashboardController::class, 'getUsersByCounsellorApi']);

// OTP Routes
Route::post('/send-mobotp', [OTPMobController::class, 'sendOTP']);
Route::post('/verify-mobotp', [OTPMobController::class, 'verifyOTP']);

// Admin Sidebar Handling Routes

// Profile and Picture Routes
Route::post('/from-profileupdate', [StudentDashboardController::class, 'updateFromProfile']);
Route::post('/upload-profile-picture', [StudentDashboardController::class, 'uploadProfilePicture']);
Route::post('/retrieve-profile-picture', [StudentDashboardController::class, 'retrieveProfilePicture']);

// Google Auth Routes
Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);

// Miscellaneous API-like Routes
Route::post('/retrieve-file', [StudentDashboardController::class, 'retrieveFile']);
Route::get("/getalluserdetailsfromadmin", [StudentDashboardController::class, 'getAllUsersFromAdmin']);
Route::get('/export-excel', [ExportController::class, 'export'])->name('export.excel');



Route::post('/upload-scuserprofile-photo', [scDashboardController::class, 'uploadScUserPhoto']);
Route::post('/view-scuserprofile-photo', [scDashboardController::class, 'retrieveScProfilePicture']);


Route::post("/register-studentcounsellor", [scDashboardController::class, 'uploadScUserInfo']);