<?php

use App\Http\Controllers\Admincontroller;
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
use App\Models\student_admin_application;
use App\Models\StudentApplicationField;
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
Route::post('/loginformdata', [LoginController::class, 'loginFormData']);
Route::post('/count-documents', [StudentDashboardController::class, 'countFilesInBucket']);
Route::post('/remaining-documents', [StudentDashboardController::class, 'getRemainingNonUploadedFiles']);
Route::post('/from-profileupdate', [StudentDashboardController::class, 'updateFromProfile']);
Route::post('/check-columns', [StudentDashboardController::class, 'validateTablesAndColumns']);
Route::post('/send-documents', [MailController::class, 'sendUserDocuments']);
Route::post('/push-user-id-request', [StudentDashboardController::class, 'pushUserIdToRequest']);
Route::post('/del-user-id-request', [StudentDashboardController::class, 'removeUserIdFromNBFCAndReject']);
Route::post('/update-user-id-request', [StudentDashboardController::class, 'updateUserIdFromNBFC']);

Route::post('/registerformdata', [RegisterController::class, 'store']);

Route::post('/send-mobotp', [OTPMobController::class, 'sendOTP']);
Route::post('/verify-mobotp', [OTPMobController::class, 'verifyOTP']);
Route::post('/emailuniquecheck', action: [RegisterController::class, 'emailUniqueCheck']);
Route::post('/updatedetailsinfo', [StudentDetailsController::class, 'updateUserIds']);

Route::post('/getUserFromNbfc', [StudentDashboardController::class, 'getUserFromNbfc']);
Route::post("/send-proposals-with-file", [NbfcController::class, 'sendProposalsWithFiles']);

Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
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
Route::post('/count-user-status', [StudentDashboardController::class, 'getStatusCount']);
Route::get('/get-messages-byconversations/{nbfc_id}/{student_id}', [ChatController::class, 'groupCountingChats']);
Route::post('/update-personalinfo', [StudentDetailsController::class, 'updatePersonalInfo']);
Route::post('/getstatusofusers', [scDashboardController::class, 'getStatusOfUsers']);
Route::post('/unread-message-count', [StudentDashboardController::class, 'unreadMessageCount']);

Route::post('/get-queries', [scDashboardController::class, 'getScuserQueryRaised']);
Route::get('/get-tickets', [scDashboardController::class, 'getScUserTickets']);
Route::post('/get-queries', [scDashboardController::class, 'getScuserQueryRaised']);
Route::get('/get-tickets', [scDashboardController::class, 'getScUserTickets']);


Route::post('/getnbfcdata-proposals', [StudentDashboardController::class, 'nbfcProposals']);
Route::post('/proposalcompletion', [StudentDashboardController::class, 'proposalCompletion']);
Route::post('/check_userid', [StudentDashboardController::class, 'checkUserId']);
Route::post('/multipleregisterbyscuser', [StudentDashboardController::class, 'multipleuserbyscuser']);
Route::get('/retrievedashboarddetails', [Admincontroller::class, 'retrieveDashboardDetails']);
Route::post('/getprofilecompletionbygender', [Admincontroller::class, 'getProfileCompletionByGenderAndDegree']);

// Admin Routes
Route::get('/getstatusofusers', [Admincontroller::class, 'pointOfEntries']);
Route::get('/nbfc-lead-gens', [Admincontroller::class, 'nbfcLeadGens']);
Route::get('/sc-lead-gens', [Admincontroller::class, 'scLeadGens']);
Route::get('/reports-on-generation', [Admincontroller::class, 'reportsOnGeneration']);
Route::post('/validateprofilecompletion', [Admincontroller::class, 'validateprofilecompletion']);
Route::get('/mergestudents', [Admincontroller::class, 'mergeAllStudentDetails']);
Route::get('/city-stats', [Admincontroller::class, 'getCityStats']);
Route::post('/suspendscuser', [scDashboardController::class, 'suspendUser']);
Route::get('/mergestudents', [Admincontroller::class, 'mergeAllStudentDetails']);

Route::get('/dest-countries', [Admincontroller::class, 'getDestinationCountries']);
Route::get('/landingpage', [Admincontroller::class, 'landingPage']);
Route::post('/promotional-email', [Admincontroller::class, 'promotionalEmail']);
Route::post('/promotional-image-attach', [Admincontroller::class, 'attachImagePromotional']);
Route::get('/student-chat-members', [Admincontroller::class, 'initializeChatStudent']);
Route::get('/nbfc-chat-members', [Admincontroller::class, 'initializeChatNbfc']);

Route::get('/get-messages-adminnbfc/{nbfc_id}/{admin_id}', [ChatController::class, 'getMessagesForAdminNbfc']);
Route::get('/get-messages-adminstudent/{student_id}/{admin_id}', [ChatController::class, 'getMessagesForAdminStudent']);
Route::post('/send-message-from-adminnbfc', action: [ChatController::class, 'sendMessageFromAdminNbfc']);
Route::post('/send-message-from-adminstudent', action: [ChatController::class, 'sendMessageFromAdminStudent']);
Route::post('/age-ratio', [Admincontroller::class, 'ageratioCalculation']);
Route::post('/sourceregister', [Admincontroller::class, 'sourceRegistration']);

Route::post('/student-application-form', [Admincontroller::class, 'store']);
Route::get('/student-application-form/{section_slug}', [Admincontroller::class, 'show']);
Route::post('/getproposalfileurl', [NbfcController::class, 'getProposalFileUrl']);
Route::post('/getprofilecompletionpercentage', [StudentDashboardController::class, 'profileCompletionByUser']);
Route::post('/loanstatuscount', [StudentDashboardController::class, 'loanStatusCount']);
Route::post('/forgot-passwordmailsent', [StudentDashboardController::class, 'forgotUserCredential']);
Route::post('/forgot-passwordmailsentnbfc', [NbfcController::class, 'forgotNbfcCredential']);
Route::post('/forgot-passwordmailsentsc', [scDashboardController::class, 'forgotScCredential']);

//education route for student-dashboard
Route::get('/education', [StudentDetailsController::class, 'getEducationDetails']);
Route::get('/getrecipients', action: [Admincontroller::class, 'fetchRecipients']);
Route::get('/admins', [Admincontroller::class, 'getAdmins']);
Route::post('/admins', [Admincontroller::class, 'createAdmin']);
Route::put('/admins/{id}', [AdminController::class, 'updateAdmin']);
Route::get('/student-forms', [AdminController::class, 'showStudentForm']);
Route::get('/student-dashboard', [StudentDashboardController::class, 'getUser']);
Route::get('/getInfoForAdminSocial', [Admincontroller::class, 'showStudentFormAdmin']);
Route::get('/getdocumenttypesadminform', [Admincontroller::class, 'showStudentPersonalInfoAdditionalField']);
Route::delete('/deleteInfoForAdminSocial/{id}', [AdminController::class, 'deleteInfoForAdminSocial']);
Route::delete('/deletedegree/{id}', [AdminController::class, 'deleteDegreesAdminside']);
Route::delete('/deletecourseduration/{id}', [AdminController::class, 'deleteCourseDuration']);
Route::delete('/deletekycdocument/{id}', [AdminController::class, 'deleteDynamicKycField']);

Route::post('/storesocialoption', [AdminController::class, 'storeSocialOption']);
Route::post('/storeplantostudycountry', [AdminController::class, 'storePlanToStudyCountry']);
Route::post('/storedegree', [AdminController::class, 'storeDegreeAdmin']);
Route::post('/storecourseduration', [AdminController::class, 'storeCourseDuration']);


Route::get('/getplantocountries', [AdminController::class, 'showStudentPlanForCountriesAdmin']);
Route::get('/showstudentcourse', [AdminController::class, 'showStudentCourse']);
Route::get('/showstudentcourseduration', [AdminController::class, 'showStudentCourseDuration']);
Route::get('/referralacceptedcounts', [AdminController::class, 'getReferralAcceptedCounts']);
Route::post('/upload-documents-chat', [AdminController::class, 'uploadChatFile']);
Route::post('/updatenbfc', [AdminController::class, 'updateNbfc']);

Route::post('/suspendnbfc', [AdminController::class, 'suspendNbfc']);
Route::post('/getuseradminside', [AdminController::class, 'getUserProfileAdminSide']);
Route::post('/update-personal-info-adminside', [AdminController::class, 'updatepersonalinfoadminside']);



Route::post('/kycdynamicpost', [Admincontroller::class, 'storeKYCDynamic']);



Route::get('/additionalpersonalinfodata', [Admincontroller::class, 'showAdditionalPersonalInfoData']);
Route::post('/addadditionalpersonalinfodata', [Admincontroller::class, 'addAdditionalPersonalInfoData']);
Route::delete('/additionalfields/{id}', [Admincontroller::class, 'deletePersonalInfoDynamicFields']);
