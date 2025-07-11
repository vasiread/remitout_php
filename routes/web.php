<?php

use App\Http\Controllers\{
    Admincontroller,
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

use App\Http\Controllers\TermsController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\NbfcController;
use App\Http\Controllers\scDashboardController;
// use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\StudentCounsellorController;
use App\Models\student_admin_application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


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
// routes/web.php
Route::get('/', [AdminController::class, 'TestimonialIndex'])->name('landing');

Route::get('/signup', function () {
    return view('pages.loginsignup');
})->name('signup');

Route::get('/terms', [TermsController::class, 'index'])->name('terms');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');
Route::get('/nbfc-dashboard', function () {
    if (!Session::has('nbfcuser')) {
        return redirect('/login'); // or wherever your login page is
    }

    return view('pages.nbfcdashboard');
})->name('nbfcdashboard');

Route::get('/admin-page', function () {
     if (!Session::has('admin')) {
        return redirect('/login');  
    }

     $sidebarItems = (new SidebarHandlingController)->admindashboardItems();
    $userDetails = (new StudentDashboardController)->getAllUsersFromAdmin();

    return view('pages.adminpage', [
        'sidebarItems' => $sidebarItems,
        'userDetails' => $userDetails,
    ]);
})->name('admin-page');




Route::post('/send-message', action: [ChatController::class, 'sendMessage']);

Route::get('/sc-dashboard', function () {
    if (!Session::has('scuser')) {
        return redirect('/login');  
    }

    $sidebarItems = (new SidebarHandlingController)->scdashboardItems();
    $userByRef = (new scDashboardController)->getUsersByCounsellor();

    return view('pages.scdashboard', [
        'sidebarItems' => $sidebarItems,
        'userByRef' => $userByRef,
    ]);
})->name('sc-dashboard');

Route::get('/download-user-report', [Admincontroller::class, 'downloadUserProfileReportPDF']);

Route::get('/student-dashboard', [StudentDashboardController::class, 'getUser'])->name('student-dashboard');

Route::get('/admin/messages/count', [AdminController::class, 'countMessagesForAdmin']);

Route::post('/admin/messages/clear-student', [AdminController::class, 'clearStudentMessagesAndGetNbfcCount']);
Route::post('/admin/messages/clear-nbfc', [AdminController::class, 'clearNbfcMessagesAndGetNbfcCount']);


// Route::get('pages/student-dashboard', [TrackController::class, 'loanTracker']);


Route::post('/registerformdata', [RegisterController::class, 'store'])->name('registerformdata');
Route::post('/emailuniquecheck', [RegisterController::class, 'emailUniqueCheck'])->name('emailUniqueCheck');
Route::post('/loginformdata', [LoginController::class, 'loginFormData'])->name('loginformdata');


Route::post('/update-personalinfo', [StudentDetailsController::class, 'updatePersonalInfo']);
Route::post('/update-courseinfo', [StudentDetailsController::class, 'updateCourseInfo']);
Route::post('/update-academicsinfo', [StudentDetailsController::class, 'updateAcademicsInfo']);
Route::post('/updatedetailsinfo', [StudentDetailsController::class, 'updateUserIds']);
Route::post("/coborrowerData", [StudentDetailsController::class, 'updateCoborrowerInfo']);
Route::post('/getUserFromNbfc', [StudentDashboardController::class, 'getUserFromNbfc'])->name('getUserFromNbfc');


Route::post('/remove-each-documents', [StudentDashboardController::class, 'removeFromServer']);
Route::post('/upload-each-documents', [StudentDashboardController::class, 'uploadMultipleDocuments']);
Route::post('/count-documents', [StudentDashboardController::class, 'countFilesInBucket']);
Route::post('/remaining-documents', [StudentDashboardController::class, 'getRemainingNonUploadedFiles']);
Route::get("/overallcounts", [TrackController::class, 'counts']);

Route::post('/check-columns', [StudentDashboardController::class, 'validateTablesAndColumns']);
Route::post('/send-documents', [MailController::class, 'sendUserDocuments']);
Route::post('/push-user-id-request', [StudentDashboardController::class, 'pushUserIdToRequest']);
Route::post('/del-user-id-request', [StudentDashboardController::class, 'removeUserIdFromNBFCAndReject']);
Route::post('/update-user-id-request', [StudentDashboardController::class, 'updateUserIdFromNBFC']);
Route::get("/getallscuser", [scDashboardController::class, 'getScAllUsers']);
Route::post('/getuserbyref', [scDashboardController::class, 'getUsersByCounsellorApi']);


Route::post('/send-mobotp', [OTPMobController::class, 'sendOTP']);
Route::post('/verify-mobotp', [OTPMobController::class, 'verifyOTP']);



Route::post('/from-profileupdate', [StudentDashboardController::class, 'updateFromProfile']);
Route::post('/upload-profile-picture', [StudentDashboardController::class, 'uploadProfilePicture']);
Route::post('/retrieve-profile-picture', [StudentDashboardController::class, 'retrieveProfilePicture']);
Route::post('/passwordchange', [GoogleAuthController::class, 'passwordChange']);
Route::post('/students/import', [scDashboardController::class, 'import_excel_post'])->name('students.import');
Route::get('/get-messages/{nbfc_id}/{student_id}', [ChatController::class, 'getMessages']);


Route::post('/retrieve-file',  [StudentDashboardController::class, 'retrieveFile']);
Route::post('/dynamic-file',  [StudentDashboardController::class, 'retrieveDynamicFiles']);

Route::get("/getalluserdetailsfromadmin", [StudentDashboardController::class, 'getAllUsersFromAdmin']);
Route::get('/export-excel', [ExportController::class, 'export'])->name('export.excel');



Route::post('/upload-scuserprofile-photo', [scDashboardController::class, 'uploadScUserPhoto']);
Route::post('/view-scuserprofile-photo', [scDashboardController::class, 'retrieveScProfilePicture']);


Route::post("/register-studentcounsellor", [scDashboardController::class, 'uploadScUserInfo']);


Route::post("/updatescuserdetails", [scDashboardController::class, 'uploadScUserDetails']);

Route::post("/scuserone", [scDashboardController::class, 'retrieveOneScUser']);
Route::post("/trace-process", [TrackController::class, 'traceuserprogress']);


Route::get("/getnbfcdata", [TrackController::class, 'getnbfcdata']);

Route::post("/addbulkusers", [NbfcController::class, 'addBulkNbfc']);
Route::post("/send-proposals-with-file", [NbfcController::class, 'sendProposalsWithFiles']);
Route::post('/logout', [LoginController::class, 'sessionLogout'])->name('logout');


Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/call-back', [GoogleAuthController::class, 'handleGoogleCallback']);


Route::get('/get-queries', [scDashboardController::class, 'getScuserQueryRaised']);
Route::post('/getstatusofusers', [scDashboardController::class, 'getStatusOfUsers']);

Route::post('/unread-message-count', [StudentDashboardController::class, 'unreadMessageCount']);
Route::get('/get-messages-byconversations/{nbfc_id}/{student_id}', [ChatController::class, 'groupCountingChats']);
Route::post('/getnbfcdata-proposals', [StudentDashboardController::class, 'nbfcProposals']);

Route::post('/proposalcompletion', [StudentDashboardController::class, 'proposalCompletion']);
Route::post('/check_userid', [StudentDashboardController::class, 'checkUserId']);
Route::post('/count-user-status', [StudentDashboardController::class, 'getStatusCount']);
Route::post('/multipleregisterbyscuser', [StudentDashboardController::class, 'multipleuserbyscuser']);
Route::post('/retrievedashboarddetails', [Admincontroller::class, 'retrieveDashboardDetails']);

Route::get('/getstatusofusersadmin', [Admincontroller::class, 'pointOfEntries']);
Route::get('/nbfc-lead-gens', [Admincontroller::class, 'nbfcLeadGens']);
Route::get('/sc-lead-gens', [Admincontroller::class, 'scLeadGens']);
Route::post('/reports-on-generation', [Admincontroller::class, 'reportsOnGeneration']);
Route::post('/validateprofilecompletion', [Admincontroller::class, 'validateprofilecompletion']);
Route::get('/city-stats', [Admincontroller::class, 'getCityStats']);
Route::get('/dest-countries', [Admincontroller::class, 'getDestinationCountries']);
Route::post('/student-application-form', [Admincontroller::class, 'store']);
Route::get('/student-application-form/{section_slug}', [Admincontroller::class, 'show']);


Route::post('/suspendscuser', [scDashboardController::class, 'suspendUser']);


Route::get('/admin/show-sc-profile/{referral}', [AdminController::class, 'showSCProfileJSON']);
Route::get('/mergestudents', [Admincontroller::class, 'mergeAllStudentDetails']);


Route::get('/get-tickets', [scDashboardController::class, 'getScUserTickets']);
Route::get('/landingpage', [Admincontroller::class, 'landingPage']);
Route::put('/landingpageupdate', [Admincontroller::class, 'updateHeroContent']);
Route::post('/promotional-email', [Admincontroller::class, 'promotionalEmail']);
Route::post('/promotional-image-attach', [Admincontroller::class, 'attachImagePromotional']);
Route::get('/student-chat-members', [Admincontroller::class, 'initializeChatStudent']);
Route::get('/nbfc-chat-members', [Admincontroller::class, 'initializeChatNbfc']);


Route::get('/get-messages-adminnbfc/{nbfc_id}/{admin_id}', [ChatController::class, 'getMessagesForAdminNbfc']);
Route::get('/get-messages-adminstudent/{student_id}/{admin_id}', [ChatController::class, 'getMessagesForAdminStudent']);
Route::post('/send-message-from-adminnbfc', [ChatController::class, 'sendMessageFromAdminNbfc']);
Route::post('/send-message-from-adminstudent', [ChatController::class, 'sendMessageFromAdminStudent']);
Route::get('/getrecipients', [Admincontroller::class, 'fetchRecipients']);


Route::post('/age-ratio', [Admincontroller::class, 'ageratioCalculation'])->name("admin.ageratio.calculation");
Route::post('/sourceregister', [Admincontroller::class, 'sourceRegistration']);
Route::post('/getproposalfileurl', [NbfcController::class, 'getProposalFileUrl']);
Route::get('/education', [StudentDetailsController::class, 'getEducationDetails']);
Route::post('/getprofilecompletionpercentage', [StudentDashboardController::class, 'profileCompletionByUser']);
Route::post('/loanstatuscount', [StudentDashboardController::class, 'loanStatusCount']);
Route::post('/forgot-passwordmailsent', [StudentDashboardController::class, 'forgotUserCredential']);
Route::post('/forgot-passwordmailsentnbfc', [NbfcController::class, 'forgotNbfcCredential']);
Route::post('/forgot-passwordmailsentsc', [scDashboardController::class, 'forgotScCredential']);
Route::get('/admins', [Admincontroller::class, 'getAdmins']);
Route::post('/admins', [Admincontroller::class, 'createAdmin']);
Route::put('/admins/{id}', [AdminController::class, 'updateAdmin']);
Route::get('/student-forms', [AdminController::class, 'showStudentForm'])->name('student-forms');
Route::get('/getInfoForAdminSocial', [Admincontroller::class, 'showStudentFormAdmin']);
Route::delete('/deleteInfoForAdminSocial/{id}', [AdminController::class, 'deleteInfoForAdminSocial']);
Route::delete('/deleteplantostudycountry/{id}', [AdminController::class, 'deleteInfoForAdminPlanToStudy']);
Route::delete('/deletedegree/{id}', [AdminController::class, 'deleteDegreesAdminside']);
Route::delete('/deletecourseduration/{id}', [AdminController::class, 'deleteCourseDuration']);

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
Route::get('/getUserProfileAdminSide', [AdminController::class, 'getUserProfileAdminSide']);
Route::post('/update-personal-info-adminside', [AdminController::class, 'updatepersonalinfoadminside']);



Route::get('/documents', [StudentDetailsController::class, 'getDynamicDocuments']);
Route::get('/getdocumenttypesadminform/{slug}', [AdminController::class, 'showStudentPersonalInfoAdditionalField']);
Route::get('/additionalpersonalinfodata', [Admincontroller::class, 'showAdditionalPersonalInfoData']);


Route::post('/kycdynamicpost', [Admincontroller::class, 'storeKYCDynamic']);
Route::delete('/deletekycdocument/{id}', [AdminController::class, 'deleteDynamicKycField']);
Route::post('/addadditionalpersonalinfodata', [Admincontroller::class, 'addAdditionalPersonalInfoData']);
Route::delete('/additionalfields/{id}', [Admincontroller::class, 'deletePersonalInfoDynamicFields']);


Route::post("/downloadzip", [StudentDashboardController::class, 'downloadFilesAsZip']);

Route::post('/raise-query', [scDashboardController::class, 'postQueryScside']);
Route::post('/update-review-status', [NbfcController::class, 'updateReviewStatus']);





Route::get('/video-url', [TermsController::class, 'getFirstVideoFromS3']);




Route::get('/academics-adminshow', [Admincontroller::class, 'getAcademicDynamicAdminSide']);
Route::delete('/academics-adminshow/{id}', [Admincontroller::class, 'deleteAcademicField']);

Route::get('/course-detail-options', [Admincontroller::class, 'getCourseExpenseOptions']);
Route::post('/course-options', [Admincontroller::class, 'addCourseExpenseOptions']);
Route::delete('/course-options/{id}', [Admincontroller::class, 'delCourseExpenseOptions']);




Route::post('/export-user-status', [scDashboardController::class, 'downloadExcelStatus']);

Route::post('/update-ticket-status', [AdminController::class, 'updateTicketStatus']);


Route::post('/send-reset-link', [LoginController::class, 'sendResetLink']);

Route::get('/reset-password', function (Request $request) {
     $token = $request->query('token');
    $type = $request->query('type');
    return view('email.resetpassword', compact('token', 'type'));
});



// POST request to send reset link
Route::post('/send-reset-link', [LoginController::class, 'sendResetLink']);
Route::post('/mark-query', [AdminController::class, 'markQuery']);
Route::get('/count-deactive-queries', [Admincontroller::class, 'countDeactiveQueries']);


Route::get('/reports/user-profile', [Admincontroller::class, 'downloadUserProfileReportPDF'])->name('download.user.profile');
Route::post('/getprofilecompletionbygender', [Admincontroller::class, 'getProfileCompletionByGenderAndDegree']);
Route::get('/retrievedashboarddetails', [Admincontroller::class, 'retrieveDashboardDetails']);

Route::post('/api/logout', function () {
    Auth::logout(); // logs out the user
    request()->session()->invalidate(); // destroys the session
    request()->session()->regenerateToken(); // prevent CSRF reuse
    return response()->json(['message' => 'Logged out successfully']);
});

Route::post('/cms/landing/update', [Admincontroller::class, 'updateLanding']);
Route::post('/admin/passwordchange', [Admincontroller::class, 'forgotAdminCredential']);





Route::get('/get-testimonialss', [Admincontroller::class, 'TestimonialIndex']);
Route::post('/testimonials-store', [Admincontroller::class, 'TestimonialStore']);



Route::post('/update-cms-imageupload', [Admincontroller::class, 'updateCmsImageContent']);
Route::get('/gettestimonials', [Admincontroller::class, 'TestimonialCMS']);


Route::post('/testimonial/upload-image/{id}', [Admincontroller::class, 'updateTestimonialImage']);

Route::post('/testimonial/update/{id}', [Admincontroller::class, 'updateTestimonial']);
Route::delete('/testimonial/delete/{id}', [Admincontroller::class, 'deleteTestimonial']);
Route::post('/testimonial/store', [Admincontroller::class, 'storeTestimonial']);


Route::get('/getfaqs', [Admincontroller::class, 'TestimonialFaqs']);
Route::get('/getlogospartner', [Admincontroller::class, 'CMSLogos']);


Route::post('/faq/store', [Admincontroller::class, 'storeFaq']);
Route::post('/faq/update/{id}', [Admincontroller::class, 'updateFaq']);
Route::delete('/faq/delete/{id}', [Admincontroller::class, 'deleteFaq']);

Route::post('/logo/store', [AdminController::class, 'addLogo']);
Route::post('/logo/update/{partnerId}', [AdminController::class, 'updateLogo']);
Route::get('/logo/show/{partnerId}', [AdminController::class, 'listLogos']);
Route::delete('/logo/delete/{logoId}', [AdminController::class, 'deleteLogo']);
Route::post('/messages/mark-all-read', [StudentDashboardController::class, 'markAllAsRead']);



Route::get('/queries/deactive-counts/{scuserid}', [scDashboardController::class, 'countDeactiveQueriesByUser']);
