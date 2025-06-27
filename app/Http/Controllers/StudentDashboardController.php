<?php

namespace App\Http\Controllers;
use App\Mail\ForgotPassword;
use App\Models\Message;
use App\Models\Nbfc;
use App\Models\proposalcompletion;
use App\Models\Queries;
use App\Models\Rejectedbynbfc;
use App\Models\Requestedbyusers;
use App\Models\Requestprogress;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use App\Models\Academics;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage; // Correct import for Storage facade
use Illuminate\Support\Facades\DB;
use App\Models\PersonalInfo;
use App\Models\CourseInfo;
use App\Models\DocumentType;
use App\Models\UserDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use ZipStream\Option\Archive as ArchiveOptions;
use ZipStream\ZipStream;
 


use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Catch_;
use ZipArchive;
class StudentDashboardController extends Controller
{
    protected $tablesAndColumns = [
        'personal_infos' => ['full_name', 'phone', 'email', 'state', 'linked_through'],
        'academic_details' => ['gap_in_academics', 'work_experience'],
        'coborrower_details' => ['plan-to-study', 'degree-type', 'course-duration', 'course-details', 'loan_amount_in_lakhs'],
        'course_details_formdata' => ['co_borrower_relation', 'co_borrower_income', 'liability_select']
    ];
    public function getUser()
    {
        $user = session('user');

        if (!$user) {
            return redirect()->route('login')->withErrors('Please log in to access your dashboard.');


        }


        $uniqueId = $user->unique_id;



        $userDetails = User::where('unique_id', $uniqueId)->get();
        $courseDetails = CourseInfo::where('user_id', $uniqueId)->get();
        $academicDetails = Academics::where('user_id', $uniqueId)->get();
        $personalDetails = PersonalInfo::where('user_id', $uniqueId)->get();


        return view('pages.studentdashboard', compact('user', 'userDetails', 'personalDetails', 'courseDetails', 'academicDetails'));
    }
    public function getUserFromNbfc(Request $request)
    {
        $request->validate([
            "userId" => "string|required",
        ]);

        $userId = $request->input('userId');

        if ($userId) {
            $userDetails = User::where('unique_id', $userId)->get();
            $courseDetails = CourseInfo::where('user_id', $userId)->get();
            $academicDetails = Academics::where('user_id', $userId)->get();
            $personalDetails = PersonalInfo::where('user_id', $userId)->get();

            // Return as JSON
            return response()->json([
                'userDetails' => $userDetails,
                'courseDetails' => $courseDetails,
                'academicDetails' => $academicDetails,
                'personalDetails' => $personalDetails,
            ]);
        }

        // If no user found, return an error
        return response()->json(['error' => 'User not found'], 404);
    }
    public function checkUserId(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|string',
                'nbfc_id' => 'required|string',

            ]);

            $user_id = $request->input("user_id");
            $nbfc_id = $request->input("nbfc_id");

            $proposal = proposalcompletion::where('user_id', $user_id)
                ->where('nbfc_id', $nbfc_id)
                ->first();

            if ($proposal) {
                return response()->json([
                    'success' => true,
                    'message' => 'Proposal found',
                    'data' => $proposal
                ]);
            }

            // Nothing found: return empty or just success=false
            return response()->json([
                'success' => false,
                'message' => 'No proposal found for this user and NBFC.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function nbfcProposals(Request $request)
    {

        try {

            $request->validate([
                'userId' => 'string|required'
            ]);

            $userId = $request->input('userId');

            $query = DB::table('traceprogress')
                ->join('nbfc', 'traceprogress.nbfc_id', '=', 'nbfc.nbfc_id') // assuming nbfc_id is the common key
                ->where('traceprogress.user_id', $userId)
                ->where('traceprogress.type', Requestprogress::TYPE_PROPOSAL)
                ->select('traceprogress.*', 'nbfc.nbfc_name') // select whatever you need
                ->get();
            ;

            return response()->json([
                'success' => true,
                'message' => 'Proposals Retrieved Successfully',
                'result' => $query
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'There is an error while retreiving proposals',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function proposalCompletion(Request $request)
    {

        try {
            $request->validate([
                'user_id' => 'string|required',
                'nbfc_id' => 'string|required',
                'proposal_accept' => 'boolean|required'
            ]);

            $userId = $request->input('user_id');
            $nbfc_id = $request->input('nbfc_id');
            $proposal_accept = $request->input('proposal_accept');


            $query = proposalcompletion::insert([
                'user_id' => $userId,
                'nbfc_id' => $nbfc_id,
                'proposal_accept' => $proposal_accept,
                'created_at' => now()

            ]);




            return response()->json([
                'success' => true,
                'message' => 'proposal final completion status updated',

            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error caught in proposal Completion',
                'error' => $e->getMessage()


            ]);

        }


    }



    public function pushUserIdToRequest(Request $request)
    {
        $request->validate([
            'userId' => 'string|required'
        ]);

        $userId = $request->input('userId');

        if ($userId) {
            $getNbfcData = Nbfc::get();

            if ($getNbfcData) {
                foreach ($getNbfcData as $data) {
                    $existingRecord = Requestprogress::where('nbfc_id', $data->nbfc_id)
                        ->where('user_id', $userId)
                        ->exists();

                    if (!$existingRecord) {
                        $pushRequest = Requestprogress::create([
                            'nbfc_id' => $data->nbfc_id,
                            'user_id' => $userId,
                            'type' => Requestprogress::TYPE_REQUEST,
                        ]);
                        if ($pushRequest) {
                            Requestedbyusers::create([
                                'userid' => $userId,
                                'nbfcid' => $data->nbfc_id
                            ]);
                        }
                    }



                }
            }


        }

        return response()->json([
            'success' => 'User Ids Sent to NBFC Requests',
            'recievedData' => $getNbfcData,
        ], 200);
    }

    public function multipleuserbyscuser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'students' => 'required|array|min:1',
            'students.*.name' => 'required|string|max:255',
            'students.*.email' => 'required|email|unique:users,email|max:255',
            'students.*.phone' => 'required|digits:10|unique:users,phone',
            'students.*.password' => 'required|string|min:8',
            'students.*.referral_code' => 'nullable|string|max:50', // ✅ new validation rule
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $students = $request->input('students');
            $createdStudents = [];

            foreach ($students as $student) {
                $user = User::create([
                    'name' => $student['name'],
                    'email' => $student['email'],
                    'phone' => $student['phone'],
                    'password' => Hash::make($student['password']),
                    'referral_code' => $student['referral_code'] ?? null, // ✅ save if provided
                ]);
                $createdStudents[] = $user;
            }

            return response()->json([
                'message' => 'Students created successfully',
                'data' => $createdStudents
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create students',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function removeUserIdFromNBFCAndReject(Request $request)
    {
        try {
            $request->validate([
                'userId' => 'string|required',
                'nbfcId' => 'string|required',
                'remarks' => 'string'
            ]);

            $userID = $request->input('userId');
            $nbfcID = $request->input('nbfcId');
            $remarks = $request->input('remarks');

            \Log::info('Received request data:', [
                'userId' => $userID,
                'nbfcId' => $nbfcID,
                'remarks' => $remarks
            ]);

            // Delete the user from Requestprogress
            $deleteCount = Requestprogress::where('nbfc_id', $nbfcID)
                ->where('user_id', $userID)
                ->delete();

            \Log::info('Delete result from Requestprogress:', ['deletedRows' => $deleteCount]);

            if ($deleteCount > 0) {
                // Check for existing rejection record
                $record = Rejectedbynbfc::where('user_id', $userID)
                    ->where('nbfc_id', $nbfcID)
                    ->first();

                if ($record) {
                    Rejectedbynbfc::where('user_id', $userID)
                    ->where('nbfc_id', $nbfcID)
                    ->update(['remarks' => $remarks]);

                    \Log::info('Rejectedbynbfc record updated.');
                } else {
                    Rejectedbynbfc::create([
                        'user_id' => $userID,
                        'nbfc_id' => $nbfcID,
                        'remarks' => $remarks
                    ]);
                    \Log::info('Rejectedbynbfc record created.');
                }
            } else {
                \Log::warning('No matching record found in Requestprogress to delete.');
            }

            return response()->json([
                'success' => true,
                'message' => 'Rejected Records stored or updated successfully',
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Error during rejection process:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred during the rejection process',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateUserIdFromNBFC(Request $request)
    {
        try {
            $request->validate([
                'userId' => 'string|required',
                'nbfcId' => 'string|required'
            ]);

            $userID = $request->input('userId');
            $nbfcID = $request->input('nbfcId');

            // Correct column names should be 'user_id' and 'nbfc_id'
            $updatedCount = Requestprogress::where('user_id', $userID)
                ->where('nbfc_id', $nbfcID)
                ->update([
                    'type' => Requestprogress::TYPE_PROPOSAL,

                ]);

            if ($updatedCount > 0) {
                return response()->json([
                    'success' => true,
                    'message' => 'Record(s) updated to Proposal for that particular NBFC successfully',
                    'updated_count' => $updatedCount,
                    'updated_at' => now()
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No matching records found to update'
                ], 404);
            }

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating records',
                'error' => $e->getMessage()
            ], 500);
        }



    }



    public function getAllUsersFromAdmin()
    {
        $users = Requestprogress::with(['nbfc', 'user'])->get();

        return $users;
    }



    public function updateFromProfile(Request $request)
    {
        try {
            $validated = $request->validate([
                'editedName' => 'nullable|string|max:255',
                'editedPhone' => 'nullable|string|max:15',
                'editedEmail' => 'nullable|email',
                'editedState' => 'nullable|string|max:255',
                'iletsScore' => 'nullable|numeric',
                'greScore' => 'nullable|numeric',
                'tofelScore' => 'nullable|numeric',
                'degreeType' => 'nullable|string',
                'planToStudy' => 'nullable|array',
                'courseDuration' => 'nullable|numeric',
                'loanAmount' => 'nullable|numeric',
                'referralCode' => 'nullable|string',
                'userId' => 'required',
                'courseName' => 'nullable|string|max:255',
                'universitySchoolName' => 'nullable|string|max:255',
                'others.otherExamName' => 'nullable|string|max:255',
                'others.otherExamScore' => 'nullable|numeric',
            ]);

            // 1. Get User
            $user = User::where('unique_id', $validated['userId'])->first();
            if (!$user) {
                return response()->json(['message' => 'User not found.'], 404);
            }

             $others = null;
            if ($request->has('others')) {
                $othersData = $request->input('others');
                if (!empty($othersData['otherExamName']) || !empty($othersData['otherExamScore'])) {
                    $others = json_encode([
                        'otherExamName' => $othersData['otherExamName'] ?? '',
                        'otherExamScore' => $othersData['otherExamScore'] ?? ''
                    ]);
                }
            }
 
            $userData = array_filter([
                'name' => $validated['editedName'] ?? null,
                'email' => $validated['editedEmail'] ?? null,
                'referral_code' => $validated['referralCode'] ?? null,
            ]);
            $user->update($userData);

            $personalInfo = PersonalInfo::where('user_id', $user->unique_id)->first();
            $personalInfoData = array_filter([
                'full_name' => $validated['editedName'] ?? null,
                'email' => $validated['editedEmail'] ?? null,
                'phone' => $validated['editedPhone'] ?? null,
                'state' => $validated['editedState'] ?? null,
            ]);

            if ($personalInfo) {
                $personalInfo->update($personalInfoData);
            } else {
                $personalInfo = PersonalInfo::create(array_merge($personalInfoData, [
                    'user_id' => $user->unique_id
                ]));
            }

            // 5. Update Academics (includes 'Others' here ✅)
            $academicsScores = Academics::where('user_id', $user->unique_id)->first();
            $academicsData = array_filter([
                'ILETS' => $validated['iletsScore'] ?? null,
                'GRE' => $validated['greScore'] ?? null,
                'TOFEL' => $validated['tofelScore'] ?? null,
                'Others' => $others,
                'course_name' => $validated['courseName'] ?? null,
                'university_school_name' => $validated['universitySchoolName'] ?? null,
            ]);

            if ($academicsScores) {
                $academicsScores->update($academicsData);
            } else {
                $academicsScores = Academics::create(array_merge($academicsData, [
                    'user_id' => $user->unique_id
                ]));
            }

            // 6. Update CourseInfo
            $courseInfoData = CourseInfo::where('user_id', $user->unique_id)->first();
            $courseInfo = array_filter([
                'plan-to-study' => $validated['planToStudy'] ?? null,
                'course-duration' => $validated['courseDuration'] ?? null,
                'loan_amount_in_lakhs' => $validated['loanAmount'] ?? null,
                'degree-type' => $validated['degreeType'] ?? null,
            ]);

            if ($courseInfoData) {
                $courseInfoData->update($courseInfo);
            } else {
                $courseInfoData = CourseInfo::create(array_merge($courseInfo, [
                    'user_id' => $user->unique_id
                ]));
            }

            // Refresh models to return latest data
            $user->refresh();
            $personalInfo?->refresh();
            $academicsScores?->refresh();
            $courseInfoData?->refresh();

            return response()->json([
                'message' => 'User details updated successfully.',
                'user' => $user,
                'personalInfo' => $personalInfo,
                'academicsScores' => $academicsScores,
                'courseInfo' => $courseInfoData,
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation error.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the profile.',
                'error' => $e->getMessage()
            ], 500);
        }
    }







    public function uploadMultipleDocuments(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
            'userId' => 'required',
            'fileNameId' => 'required|string',
            'sourceType'=>'required|string'
        ]);
        $userId = $request->input('userId');
        $Category = $request->input('fileNameId');
        $sourceType = $request->input('sourceType');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $fileDirectory = "$userId/$sourceType/$Category";


            $existingFiles = Storage::disk('s3')->files($fileDirectory);
            if (!empty($existingFiles)) {
                Storage::disk('s3')->delete($existingFiles);
            }

            $filePath = $file->storeAs(
                $fileDirectory,
                $fileName,
                [
                    'disk' => 's3',
                    'visibility' => 'public',
                ]
            );
            $fileUrl = Storage::disk('s3')->url($filePath);
            return response()->json([
                'message' => 'File uploaded successfully!',
                'file_name' => $fileName,
                'file_path' => $fileUrl,
            ]);
        }






    }

    public function removeFromServer(Request $request)
    {
        $request->validate([
            'userId' => 'required',
            'fileNameId' => 'required|string',
            'sourceType' => 'required|string',
        ]);

        $userId = $request->input('userId');
        $fileNameId = $request->input('fileNameId');
        $sourceType = $request->input('sourceType');

        $fileDirectory = "$userId/$sourceType/$fileNameId";

        $existingFiles = Storage::disk('s3')->files($fileDirectory);

        if (!empty($existingFiles)) {
            $deleteResult = Storage::disk('s3')->delete($existingFiles);

            if ($deleteResult) {
                return response()->json([
                    'message' => 'Files deleted successfully!',
                ], 200);
            } else {
                return response()->json([
                    'message' => 'There was an error deleting the files.',
                ], 500);
            }
        } else {
            return response()->json([
                'message' => 'No files found to delete.',
            ], 404);
        }
    }







    public function uploadProfilePicture(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
            'userId' => 'required'
        ]);

        $userId = $request->input('userId');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $fileDirectory = "$userId/profile_pictures";

            $existingFiles = Storage::disk('s3')->files($fileDirectory);
            if (!empty($existingFiles)) {
                Storage::disk('s3')->delete($existingFiles);
            }

            $filePath = $file->storeAs(
                $fileDirectory,
                $fileName,
                [
                    'disk' => 's3',
                    'visibility' => 'public',
                ]
            );
            $fileUrl = Storage::disk('s3')->url($filePath);


            return response()->json([
                'message' => 'File uploaded successfully!',
                'file_name' => $fileName,
                'file_path' => $fileUrl,
            ], 200);
        }

        // Return an error response if no file is uploaded
        return response()->json([
            'message' => 'No file uploaded.',
        ], 400);
    }


    public function retrieveProfilePicture(Request $request)
    {
        $request->validate([
            'userId' => 'required|string',
        ]);

        $userId = $request->input('userId');

        $filePath = "$userId/profile_pictures";

        $files = Storage::disk('s3')->files($filePath);

        if (!empty($files)) {
            $file = $files[0];

            $fileUrl = Storage::disk('s3')->url($file);

            return response()->json([
                'message' => 'Profile picture retrieved successfully.',
                'fileUrl' => $fileUrl,  // This is the actual S3 URL
            ], 200);
        }

        return response()->json([
            'message' => 'No profile picture found for this user.',
        ], 404);
    }
    // public function aadharCardView(Request $request)
    // {
    //     // Validate the incoming request
    //     $request->validate([
    //         'userId' => 'required|string',
    //     ]);

    //     // Retrieve user ID
    //     $userId = $request->input('userId');

    //     // Define the file path for the profile pictures folder
    //     $filePath = "$userId/aadhar-card-name";  // Assuming profile pictures are stored in this structure

    //     // Get the list of files in the user's profile pictures directory
    //     $files = Storage::disk('s3')->files($filePath);

    //     // Check if there are any files (there should be one per user)
    //     if (!empty($files)) {
    //         $file = $files[0];  // Get the first file (we expect only one profile picture per user)

    //         // Generate the URL of the file
    //         $fileUrl = Storage::disk('s3')->url($file);

    //         return response()->json([
    //             'message' => 'Aadhar Card Url retrieved successfully.',
    //             'fileUrl' => $fileUrl,  // This is the actual S3 URL
    //         ], 200);
    //     }

    //     // If no profile picture exists for the user, return an error message
    //     return response()->json([
    //         'message' => 'No profile picture found for this user.',
    //     ], 404);
    // }
    // public function passportView(Request $request)
    // {
    //      $request->validate([
    //         'userId' => 'required|string',
    //     ]);

    //      $userId = $request->input('userId');

    //      $filePath = "$userId/pan-card-name";  

    //      $files = Storage::disk('s3')->files($filePath);

    //      if (!empty($files)) {
    //         $file = $files[0]; 

    //         $fileUrl = Storage::disk('s3')->url($file);

    //         return response()->json([
    //             'message' => 'Pan Card URL retrieved successfully.',
    //             'fileUrl' => $fileUrl,  // This is the actual S3 URL
    //         ], 200);
    //     }

    //     // If no profile picture exists for the user, return an error message
    //     return response()->json([
    //         'message' => 'No profile picture found for this user.',
    //     ], 404);
    // }
    // public function pancardView(Request $request)
    // {
    //     // Validate the incoming request
    //     $request->validate([
    //         'userId' => 'required|string',
    //     ]);

    //     // Retrieve user ID
    //     $userId = $request->input('userId');

    //     // Define the file path for the profile pictures folder
    //     $filePath = "$userId/passport-name";  // Assuming profile pictures are stored in this structure

    //     // Get the list of files in the user's profile pictures directory
    //     $files = Storage::disk('s3')->files($filePath);

    //     // Check if there are any files (there should be one per user)
    //     if (!empty($files)) {
    //         $file = $files[0]; 


    //         // Generate the URL of the file
    //         $fileUrl = Storage::disk('s3')->url($file);

    //         return response()->json([
    //             'message' => 'Passport URL retrieved successfully.',
    //             'fileUrl' => $fileUrl,  // This is the actual S3 URL
    //         ], 200);
    //     }

    //     // If no profile picture exists for the user, return an error message
    //     return response()->json([
    //         'message' => 'No profile picture found for this user.',
    //     ], 404);
    // }
    // public function sslcmarksheetView(Request $request)
    // {
    //     // Validate the incoming request
    //     $request->validate([
    //         'userId' => 'required|string',
    //     ]);

    //     // Retrieve user ID
    //     $userId = $request->input('userId');

    //     // Define the file path for the profile pictures folder
    //     $filePath = "$userId/tenth-grade-name";  // Assuming profile pictures are stored in this structure

    //     // Get the list of files in the user's profile pictures directory
    //     $files = Storage::disk('s3')->files($filePath);

    //     // Check if there are any files (there should be one per user)
    //     if (!empty($files)) {
    //         $file = $files[0];  // Get the first file (we expect only one profile picture per user)

    //         // Generate the URL of the file
    //         $fileUrl = Storage::disk('s3')->url($file);

    //         return response()->json([
    //             'message' => '10th marksheet URL retrieved successfully.',
    //             'fileUrl' => $fileUrl,  // This is the actual S3 URL
    //         ], 200);
    //     }

    //     // If no profile picture exists for the user, return an error message
    //     return response()->json([
    //         'message' => 'No profile picture found for this user.',
    //     ], 404);
    // }
    // public function hscmarksheetView(Request $request)
    // {
    //     // Validate the incoming request
    //     $request->validate([
    //         'userId' => 'required|string',
    //     ]);

    //     // Retrieve user ID
    //     $userId = $request->input('userId');

    //     // Define the file path for the profile pictures folder
    //     $filePath = "$userId/twelfth-grade-name";  // Assuming profile pictures are stored in this structure

    //     // Get the list of files in the user's profile pictures directory
    //     $files = Storage::disk('s3')->files($filePath);

    //     // Check if there are any files (there should be one per user)
    //     if (!empty($files)) {
    //         $file = $files[0];  // Get the first file (we expect only one profile picture per user)

    //         // Generate the URL of the file
    //         $fileUrl = Storage::disk('s3')->url($file);

    //         return response()->json([
    //             'message' => '12th Marksheet retrieved successfully.',
    //             'fileUrl' => $fileUrl,  // This is the actual S3 URL
    //         ], 200);
    //     }

    //     // If no profile picture exists for the user, return an error message
    //     return response()->json([
    //         'message' => 'No profile picture found for this user.',
    //     ], 404);
    // }
    // public function graduationmarksheetView(Request $request)
    // {
    //     // Validate the incoming request
    //     $request->validate([
    //         'userId' => 'required|string',
    //     ]);

    //     // Retrieve user ID
    //     $userId = $request->input('userId');

    //     // Define the file path for the profile pictures folder
    //     $filePath = "$userId/graduation-grade-name";  // Assuming profile pictures are stored in this structure

    //     // Get the list of files in the user's profile pictures directory
    //     $files = Storage::disk('s3')->files($filePath);

    //     // Check if there are any files (there should be one per user)
    //     if (!empty($files)) {
    //         $file = $files[0];  // Get the first file (we expect only one profile picture per user)

    //         // Generate the URL of the file
    //         $fileUrl = Storage::disk('s3')->url($file);

    //         return response()->json([
    //             'message' => 'Graduation Marksheet URL retrieved successfully.',
    //             'fileUrl' => $fileUrl,  // This is the actual S3 URL
    //         ], 200);
    //     }

    //     // If no profile picture exists for the user, return an error message
    //     return response()->json([
    //         'message' => 'No profile picture found for this user.',
    //     ], 404);
    // }


    public function retrieveFile(Request $request)
    {
        $request->validate([
            'userId' => 'required|string',
            'fileTypes' => 'required|array',
        ]);

        $userId = $request->input('userId');    
        $fileTypes = $request->input('fileTypes');
        $disk = Storage::disk('s3');

        $response = [];

         
        foreach ($fileTypes as $fileType) {
            $cleanType = str_replace('static/', '', $fileType);
            $staticPath = "$userId/static/$cleanType";

            $staticFiles = $disk->files($staticPath);

            if (!empty($staticFiles)) {
                $file = $staticFiles[0];
                $response[$fileType] = [
                    'url' => $disk->url($file),
                    'size' => $disk->size($file), 
                ];
            } else {
                $response[$fileType] = null;
            }
        }

        
        $allDirectories = $disk->directories($userId);

        foreach ($allDirectories as $folderPath) {
            $folderName = basename($folderPath);

            if (in_array($folderName, $fileTypes)) {
                continue;
            }

            $filesInFolder = $disk->files($folderPath);
            if (!empty($filesInFolder)) {
                $file = $filesInFolder[0];
                $response[$folderName] = [
                    'url' => $disk->url($file),
                    'size' => $disk->size($file), // Size in bytes
                ];
            }
        }

        return response()->json(['staticFiles' => $response], 200);
    }







    public function countFilesInBucket(Request $request)
    {
        $request->validate([
            'userId' => 'required|string'
        ]);

        $userId = $request->input('userId');
        $folderPath = "$userId/static";

        // Static
        $files = Storage::disk("s3")->allFiles($folderPath);
        $documentCount = count($files);

        // Dynamic
        $dynamicFolderPath = "$userId/dynamic";
        $dynamicFiles = Storage::disk("s3")->allFiles($dynamicFolderPath);
        $dynamicDocumentCount = count($dynamicFiles);

        // Direct UserDocument count (if no relationship)
        $userDocumentCount = DocumentType::count(); // add ->where('user_id', $userId) if needed

        // Total
        $totalDocuments = $documentCount + $dynamicDocumentCount + $userDocumentCount + 22;

        return response()->json([
            'message' => 'Documents counts retrieved successfully',
            'documentscount' => $documentCount,
            'staticDocuments' => $documentCount,
            'dynamicDocuments' => $dynamicDocumentCount,
            'userDocumentCount' => $userDocumentCount,
            'totalDocuments' => $totalDocuments,
        ], 200);
    }



    public function getRemainingNonUploadedFiles(Request $request)
    {
        $request->validate([
            'userId' => 'required|string'
        ]);

        $userId = $request->input('userId');
        $folderPath = "$userId/static";

        $expectedFolders = [
            'aadhar-card-name',
            'co-aadhar-card-name',
            'co-addressproof',
            'co-pan-card-name',
            'graduation-grade-name',
            'pan-card-name',
            'passport-name',
            'salary-upload-address-proof-name',
            'salary-upload-salary-slip-name',
            'secured-graduation-name',
            'secured-tenth-name',
            'secured-twelfth-name',
            'tenth-grade-name',
            'twelfth-grade-name',
            'work-experience-experience-letter',
            'work-experience-joining-letter',
            'work-experience-monthly-slip',
            'work-experience-office-id'
        ];

        $missingDocuments = [];

        foreach ($expectedFolders as $folder) {
            $pathToCheck = "$folderPath/$folder";
            $filesInFolder = Storage::disk("s3")->files($pathToCheck);

            if (empty($filesInFolder)) {
                $missingDocuments[] = $folder . '/'; // 👈 return with trailing slash to match frontend
            }
        }

        return response()->json([
            'message' => 'Documents count retrieved successfully',
            'missingDocuments' => $missingDocuments,
        ], 200);
    }















    public function getStudentProfile($studentId)
    {
        $student = Student::find($studentId);
        return view('pages.studentdashboard', compact('student'));
    }




    public function downloadFilesAsZip(Request $request)
    {
        $userId = $request->input('userId');

        if (!$userId) {
            return response()->json(['error' => 'User ID is required'], 400);
        }

        $disk = Storage::disk('s3'); // or 'local'
        $allFiles = $disk->allFiles($userId);

        if (empty($allFiles)) {
            return response()->json(['error' => 'No documents uploaded yet.'], 404);
        }


        if (ob_get_level())
            ob_end_clean();

        $zipFileName = "user_files_{$userId}.zip";
        $options = new ArchiveOptions();
        $options->setSendHttpHeaders(true);
        $options->setContentType('application/zip');
        $options->setContentDisposition("attachment; filename=\"{$zipFileName}\"");

        return response()->stream(function () use ($disk, $allFiles, $userId, $options) {
            $zip = new ZipStream(null, $options);

            foreach ($allFiles as $filePath) {
                $stream = $disk->readStream($filePath);
                if (!$stream)
                    continue;

                $relativePath = substr($filePath, strlen($userId) + 1);
                if (!empty($relativePath)) {
                    $zip->addFileFromStream($relativePath, $stream);
                }

                fclose($stream);
            }

            $zip->finish();
        });
    }


    public function updateReadMessage(Request $request)
    {

        $request->validate([
            'conversation_id' => 'required|',
            'receiverId' => 'receiverId'
        ]);

        $conversationId = $request->input('conversation_id');
        $receiverId = $request->input('receiverId');

        $updatedRead = Message::where('conversation_id', $conversationId)
            ->where('receiver_id', $receiverId)
            ->where('is_read', 0)
            ->update([
                'is_read' => 1,
            ]);










    }
    public function getStatusCount(Request $request)
    {

        try {



            $request->validate([
                'userId' => 'string|required'
            ]);

            $userId = $request->input('userId');

            $query = Requestprogress::where("user_id", $userId)
                ->where('type', 'proposal')
                ->count();





            return response()->json([
                'success' => true,
                'message' => "count retrieved",
                'count' => $query
            ]);


        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "count not retrieved",
                'error' => $e->getMessage()
            ]);
        }

    }
    public function unreadMessageCount(Request $request)
    {

        try {
            $request->validate([
                'receiverId' => 'string|required'
            ]);

            $receiverId = $request->input('receiverId');

            $count = Message::where('receiver_id', $receiverId)
                ->where('is_read', false)->count();


            return response()->json([
                'success' => true,
                'message' => "Message Count Retrieved",
                'count' => $count

            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }






    }





    public function profileCompletionByUser(Request $request)
    {
        $userId = trim($request->input('userId'));

        if (empty($userId)) {
            return response()->json(['error' => 'user_id is required'], 400);
        }

        // Tables and profile fields to check
        $tablesAndColumns = [
            'users' => ['email', 'phone'],
            'personal_infos' => ['full_name', 'referral_code', 'state', 'linked_through', 'gender'],
            'academic_details' => ['gap_in_academics', 'work_experience', 'university_school_name', 'course_name'],
            'coborrower_details' => [
                'co_borrower_relation',
                'co_borrower_income',
                'co_borrower_monthly_liability',
                'liability_select'
            ],
            'course_details_formdata' => [
                'plan-to-study',
                'degree-type',
                'course-duration',
                'course-details',
                'loan_amount_in_lakhs'
            ],
        ];

        $totalColumns = 0;
        $filledColumns = 0;

        foreach ($tablesAndColumns as $table => $columns) {
            if (!Schema::hasTable($table))
                continue;

            $data = ($table === 'users')
            ? DB::table($table)->where('unique_id', $userId)->first()
                : DB::table($table)->where('user_id', $userId)->first();

            foreach ($columns as $column) {
                $totalColumns++;
                if (Schema::hasColumn($table, $column)) {
                    $value = $data->$column ?? null;
                    if (!is_null($value) && trim((string) $value) !== '') {
                        $filledColumns++;
                    }
                }
            }
        }

        // ✅ Document logic
        $dynamicDocumentCount = DocumentType::count(); // Document types count
        $documents_expected = 22 + $dynamicDocumentCount;

        $folderPath = "$userId";
        $files = Storage::disk("s3")->allFiles($folderPath);
        $rawDocumentCount = count($files);
        $adjustedDocumentCount = max(0, $rawDocumentCount - 1); // Avoid negative

        // ✅ Use updated expected count
        $documentPercentage = ($documents_expected > 0)
            ? ($adjustedDocumentCount / $documents_expected) * 100
            : 0;

        $profilePercentage = ($totalColumns > 0)
            ? ($filledColumns / $totalColumns) * 100
            : 0;

        $overallPercentage = ($profilePercentage + $documentPercentage) / 2;

        return response()->json([
            'user_id' => $userId,
            'profile_fields_total' => $totalColumns,
            'profile_fields_filled' => $filledColumns,
            'profile_completion_percentage' => round($profilePercentage, 2),

            'documents_expected' => $documents_expected,
            'documents_uploaded_raw' => $rawDocumentCount,
            'documents_counted' => $adjustedDocumentCount,
            'document_completion_percentage' => round($documentPercentage, 2),

            'overall_completion_percentage' => (int) round($overallPercentage)
        ]);
    }


    public function loanStatusCount(Request $request)
    {
        // Validate the request input for user_id
        $request->validate([
            'user_id' => 'required|string'
        ]);

        $userId = $request->input('user_id');

        // Count the 'received' proposals
        $receivedCount = Requestprogress::where('user_id', $userId)
            ->where('type', Requestprogress::TYPE_PROPOSAL)
            ->count();

        // Count the 'hold' requests
        $holdCount = Requestprogress::where('user_id', $userId)
            ->where('type', Requestprogress::TYPE_REQUEST)
            ->count();

        // Count the rejections grouped by nbfc_id
        $rejectedCount = Rejectedbynbfc::where('user_id', $userId)
            ->groupBy('nbfc_id')
            ->selectRaw('nbfc_id, COUNT(*) as count')
            ->get();

        // Return the counts in a response
        return response()->json([
            'received_proposals' => $receivedCount,
            'hold_requests' => $holdCount,
            'rejected_by_nbfc' => $rejectedCount,
        ]);
    }



    public function forgotUserCredential(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $newPassword = Str::random(10);

        if ($user->password !== Hash::make($newPassword)) {
            $user->password = Hash::make($newPassword);  // Encrypt password before saving
            $user->save();

            Mail::to($user->email)->send(new ForgotPassword(
                $user->email,
                $user->unique_id,
                $newPassword
            ));

            return response()->json(['message' => 'A new password has been sent to your email.']);
        } else {
            return response()->json(['message' => 'The password has not changed.']);
        }
    }


    public function markAllAsRead(Request $request)
    {
        $userId = $request->input('userId');  

        Message::where('receiver_id', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['status' => 'success']);
    }











}
