<?php

use App\Http\Controllers\AuthController;
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


Route::get('pages/student-dashboard', [TrackController::class, 'loanTracker']);


Route::post('/registerformdata', [RegisterController::class, 'store'])->name('registerformdata');
Route::post('/loginformdata', [LoginController::class, 'loginFormData'])->name('loginformdata');
Route::post('/update-personalinfo', [StudentDetailsController::class, 'updatePersonalInfo']);
Route::post('/update-courseinfo', [StudentDetailsController::class, 'updateCourseInfo']);
Route::post('/update-academicsinfo', [StudentDetailsController::class, 'updateAcademicsInfo']);




Route::post('/send-email', [MailController::class, 'sendEmail']);
Route::post('/verify-otp', [MailController::class, 'verifyOTP']);
Route::get('/student-dashboard', [StudentDashboardController::class, 'getUser'])->name('student-dashboard');
