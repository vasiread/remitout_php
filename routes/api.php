<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\NbfcController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OTPMobController;
use App\Http\Controllers\scDashboardController;
use App\Http\Controllers\SidebarHandlingController;
use App\Http\Controllers\StudentCounsellorController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentDetailsController;
use App\Http\Controllers\TrackController;
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
Route::post('/retrieve-profile-picture', [StudentDashboardController::class, 'retrieveProfilePicture']);
Route::post('/retrieve-pan-card', [StudentDashboardController::class, 'panCardView']);
Route::post('/retrieve-aadhar-card', [StudentDashboardController::class, 'aadharCardView']);
Route::post('/loginformdata', [LoginController::class, 'loginFormData'])->name('loginformdata');
Route::post('/count-documents', [StudentDashboardController::class, 'countFilesInBucket']);
Route::post('/remaining-documents', [StudentDashboardController::class, 'getRemainingNonUploadedFiles']);
Route::post('/from-profileupdate', [StudentDashboardController::class, 'updateFromProfile']);
Route::post('/check-columns', [StudentDashboardController::class, 'validateTablesAndColumns']);
Route::post('/send-documents', [MailController::class, 'sendUserDocuments']);
Route::post('/push-user-id-request', [StudentDashboardController::class, 'pushUserIdToRequest']);
Route::post('/del-user-id-request', [StudentDashboardController::class, 'removeUserIdFromNBFCAndReject']);
Route::post('/update-user-id-request', [StudentDashboardController::class, 'updateUserIdFromNBFC']);


Route::post('/send-mobotp', [OTPMobController::class, 'sendOTP']);
Route::post('/verify-mobotp', [OTPMobController::class, 'verifyOTP']);
Route::post('/emailuniquecheck', action: [RegisterController::class, 'emailUniqueCheck']);
Route::post('/updatedetailsinfo', [StudentDetailsController::class, 'updateUserIds']);

Route::post('/getUserFromNbfc', [StudentDashboardController::class, 'getUserFromNbfc'])->name('getUserFromNbfc');


Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);
Route::post('/passwordchange', [GoogleAuthController::class, 'passwordChange']);
Route::get("/getalluserdetailsfromadmin", [StudentDashboardController::class, 'getAllUsersFromAdmin']);
Route::post('/retrieve-file', action: [StudentDashboardController::class, 'retrieveFile']);
Route::post('/remove-each-documents', [StudentDashboardController::class, 'removeFromServer']);

Route::post('/getuserbyref', [scDashboardController::class, 'getUsersByCounsellorApi']);


Route::post("/register-studentcounsellor", [scDashboardController::class, 'uploadScUserInfo']);
Route::post("/updatescuserdetails", [scDashboardController::class, 'uploadScUserDetails']);
Route::post("/scuserone", [scDashboardController::class, 'retrieveOneScUser']);
Route::post("/trace-process", [TrackController::class, 'traceuserprogress']);
Route::get("/getnbfcdata", [TrackController::class, 'getnbfcdata']);
Route::get("/overallcounts", [TrackController::class, 'counts']);
Route::post("/addbulkusers", [NbfcController::class, 'addBulkNbfc']);

Route::post("/downloadzip", [StudentDashboardController::class, 'downloadFilesAsZip']);

Route::post('/send-message', action: [ChatController::class, 'sendMessage']);
Route::get('/get-messages/{nbfc_id}/{student_id}', [ChatController::class, 'getMessages']);