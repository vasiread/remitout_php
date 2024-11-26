<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RegisterController;
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


Route::post('/registerformdata', [RegisterController::class, 'store'])->name('registerformdata');
Route::post('/loginformdata', [LoginController::class, 'loginFormData'])->name('loginformdata');



Route::post('/send-email', [MailController::class, 'sendEmail']);
Route::post('/verify-otp', [MailController::class, 'verifyOTP']);
