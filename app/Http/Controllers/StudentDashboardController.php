<?php

namespace App\Http\Controllers;
use App\Models\Nbfc;
use App\Models\Rejectedbynbfc;
use App\Models\Requestprogress;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use App\Models\Academics;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\PersonalInfo;
use App\Models\CourseInfo;
use PhpParser\Node\Stmt\Catch_;
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


        // $personalInfo = $user->personalInfo;
        // $academicDetails = $user->academicsInfo;

        // Ensure this returns the view
        return view('pages.studentdashboard', compact('user', 'userDetails', 'personalDetails', 'courseDetails', 'academicDetails'));
    }
    // In SidebarHandlingController (or any controller)


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
                        Requestprogress::create([
                            'nbfc_id' => $data->nbfc_id,
                            'user_id' => $userId,
                            'type' => Requestprogress::TYPE_REQUEST,
                        ]);
                    }
                }
            }

        }

        return response()->json([
            'success' => 'User Ids Sent to NBFC Requests',
            'recievedData' => $getNbfcData,
        ], 200);
    }

    public function removeUserIdFromNBFCAndReject(Request $request)
    {
        try {
            $request->validate([
                'userId' => 'string|required',
                'nbfcId' => 'string|required',
                'remarks' => 'string'
            ]);

            // Log incoming data to ensure it's correct
            \Log::info('Received request data:', [
                'userId' => $request->input('userId'),
                'nbfcId' => $request->input('nbfcId'),
                'remarks' => $request->input('remarks')
            ]);

            $userID = $request->input('userId');
            $nbfcID = $request->input('nbfcId');
            $remarks = $request->input('remarks');

            $deleteQuery = Requestprogress::where('nbfc_id', $nbfcID)
                ->where('user_id', $userID)
                ->delete();

            if ($deleteQuery) {
                $record = Rejectedbynbfc::create([
                    'user_id' => $userID,
                    'nbfc_id' => $nbfcID,
                    'remarks' => $remarks
                ]);
            }

            if ($record) {
                return response()->json([
                    'success' => true,
                    'message' => 'Rejected Records stored successfully',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to store rejected records'
                ], 404);
            }

        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error during rejection process:', ['error' => $e->getMessage()]);

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

        $userDetails = DB::table('traceprogress')
            ->join('users', 'traceprogress.user_id', '=', 'users.unique_id')->join('nbfc', 'traceprogress.nbfc_id', '=', 'nbfc.nbfc_id')
            ->where('traceprogress.type', Requestprogress::TYPE_PROPOSAL)
            ->select('traceprogress.*', 'users.name as user_name', 'nbfc.nbfc_name') // Select all requestprogress data and the names
            ->get();



        return $userDetails;


    }
    public function updateFromProfile(Request $request)
    {
        try {
            // Validate request data
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
                'userId' => 'required'
            ]);

            // Find the user by unique_id
            $user = User::where('unique_id', $validated['userId'])->first();
            if (!$user) {
                return response()->json(['message' => 'User not found.'], 404);
            }

            // Group 1: Update User details
            $userData = array_filter([
                'name' => $validated['editedName'] ?? null,
                'email' => $validated['editedEmail'] ?? null,
            ], function ($value) {
                return $value !== null; // Exclude null values
            });
            $user->update($userData);

            // Group 2: Update Personal Info details
            $personalInfo = PersonalInfo::where('user_id', $user->unique_id)->first();
            $personalInfoData = array_filter([
                'full_name' => $validated['editedName'] ?? null,
                'email' => $validated['editedEmail'] ?? null,
                'phone' => $validated['editedPhone'] ?? null,
                'state' => $validated['editedState'] ?? null,
                'referral_code' => $validated['referralCode'] ?? null,
            ], function ($value) {
                return $value !== null;
            });

            if ($personalInfo) {
                $personalInfo->update($personalInfoData);
            } else {
                PersonalInfo::create(array_merge($personalInfoData, ['user_id' => $user->unique_id]));
            }

            // Group 3: Update Academic Scores
            $academicsScores = Academics::where('user_id', $user->unique_id)->first();
            $academicsData = array_filter([
                'ILETS' => $validated['iletsScore'] ?? null,
                'GRE' => $validated['greScore'] ?? null,
                'TOFEL' => $validated['tofelScore'] ?? null,
            ], function ($value) {
                return $value !== null;
            });

            if ($academicsScores) {
                $academicsScores->update($academicsData);
            } else {
                Academics::create(array_merge($academicsData, ['user_id' => $user->unique_id]));
            }

            // Group 4: Update Course Info
            $courseInfoData = CourseInfo::where('user_id', $user->unique_id)->first();
            $planToStudy = $validated['planToStudy'] ?? null;

            $courseInfo = array_filter([
                'plan-to-study' => $planToStudy,
                'course-duration' => $validated['courseDuration'] ?? null,
                'loan_amount_in_lakhs' => $validated['loanAmount'] ?? null,
                'degree-type' => $validated['degreeType'] ?? null,
            ], function ($value) {
                return $value !== null;
            });

            if ($courseInfoData) {
                $courseInfoData->update($courseInfo);
            } else {
                CourseInfo::create(array_merge($courseInfo, ['user_id' => $user->unique_id]));
            }

            // Refresh all models to return the latest data (check if each model exists)
            $user->refresh();
            if ($personalInfo)
                $personalInfo->refresh();
            if ($academicsScores)
                $academicsScores->refresh();
            if ($courseInfoData)
                $courseInfoData->refresh();

            // Return a JSON response with success message
            return response()->json([
                'message' => 'User details updated successfully.',
                'user' => $user,
                'personalInfo' => $personalInfo,
                'academicsScores' => $academicsScores,
                'courseInfo' => $courseInfoData
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation errors as JSON
            return response()->json([
                'message' => 'Validation error.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Catch any other errors
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
        ]);
        $userId = $request->input('userId');
        $Category = $request->input('fileNameId');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $fileDirectory = "$userId/$Category";


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
        ]);

        $userId = $request->input('userId');
        $fileNameId = $request->input('fileNameId');

        $fileDirectory = "$userId/$fileNameId";

        $existingFiles = Storage::disk('s3')->files($fileDirectory);

        if (!empty($existingFiles)) {
            // Attempt to delete the files
            $deleteResult = Storage::disk('s3')->delete($existingFiles);

            // Ensure a proper JSON response
            if ($deleteResult) {
                return response()->json([
                    'message' => 'Files deleted successfully!',
                ], 200); // Ensure status code 200 for successful deletion
            } else {
                return response()->json([
                    'message' => 'There was an error deleting the files.',
                ], 500); // Internal server error if deletion fails
            }
        } else {
            return response()->json([
                'message' => 'No files found to delete.',
            ], 404); // Not found if no files exist
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
            'fileType' => 'required|string',
        ]);

        $userId = $request->input('userId');
        $fileType = $request->input('fileType');

        // Path where the files are stored based on user ID and file type
        $filePath = "$userId/$fileType";

        // Fetch files from the S3 bucket
        $files = Storage::disk('s3')->files($filePath);

        if (!empty($files)) {
            // Get the first file in the list
            $file = $files[0];

            // Generate the URL for the file
            $fileUrl = Storage::disk('s3')->url($file);

            // Return success response with file URL
            return response()->json([
                'message' => ucfirst(str_replace('-', ' ', $fileType)) . ' retrieved successfully.',
                'fileUrl' => $fileUrl,
            ], 200);
        }

        return response()->json([
            'message' => 'No file found for the specified type.',
            'fileUrl' => null,
        ], 200);
    }





    public function countFilesInBucket(Request $request)
    {
        $request->validate([
            'userId' => 'required|string'
        ]);
        $userId = $request->input('userId');
        $folderPath = "$userId";

        $files = Storage::disk("s3")->allFiles($folderPath);
        $documentCount = count($files);


        return response()->json([
            'message' => 'Documents counts retreived successfully',
            'documentscount' => $documentCount - 1,

        ], 200);


    }


    public function getRemainingNonUploadedFiles(Request $request)
    {
        $request->validate([
            'userId' => 'required|string'
        ]);

        $userId = $request->input('userId');
        $folderPath = "$userId/";

        $expectedFolders = [
            'aadhar-card-name/',
            'co-aadhar-card-name/',
            'co-addressproof/',
            'co-pan-card-name/',
            'graduation-grade-name/',
            'pan-card-name/',
            'passport-name/',
            'salary-upload-address-proof-name/',
            'salary-upload-salary-slip-name/',
            'secured-graduation-name/',
            'secured-tenth-name/',
            'secured-twelfth-name/',
            'tenth-grade-name/',
            'twelfth-grade-name/',
            'work-experience-experience-letter/',
            'work-experience-joining-letter/',
            'work-experience-monthly-slip/',
            'work-experience-office-id/'
        ];

        $missingDocuments = [];

        foreach ($expectedFolders as $folder) {
            $filesInFolder = Storage::disk("s3")->files($folderPath . $folder);

            if (empty($filesInFolder)) {
                $missingDocuments[] = $folder;
            }
        }

        return response()->json([
            'message' => 'Documents count retrieved successfully',
            'missingDocuments' => $missingDocuments,
        ], 200);
    }







    public function validateProfileCompletion(Request $request)
    {
        $userId = $request->input('user_id');
        if (!$userId) {
            return response()->json(['error' => 'User ID is required'], 400);
        }

        $validationResult = [];
        $totalColumns = 0;
        $filledColumns = 0;

        foreach ($this->tablesAndColumns as $table => $columns) {
            if (Schema::hasTable($table)) {
                $tableStatus = ['table_exists' => true, 'columns' => []];

                // Fetch all necessary columns at once for the specific user
                $userData = DB::table($table)->where('user_id', $userId)->first();

                foreach ($columns as $column) {
                    $totalColumns++;

                    // Check if the column exists in the table schema
                    if (Schema::hasColumn($table, $column)) {
                        $value = $userData ? $userData->$column : null;

                        if (!empty($value)) {
                            $tableStatus['columns'][$column] = 'Filled';
                            $filledColumns++;
                        } else {
                            $tableStatus['columns'][$column] = 'Not Filled';
                        }
                    } else {
                        $tableStatus['columns'][$column] = 'Column does not exist';
                    }
                }

                $validationResult[$table] = $tableStatus;
            } else {
                $validationResult[$table] = ['table_exists' => false, 'columns' => 'Table does not exist'];
            }
        }

        $completionPercentage = ($totalColumns > 0) ? ($filledColumns / $totalColumns) * 100 : 0;

        return response()->json([
            'profile_completion_percentage' => $completionPercentage,
            'validation_result' => $validationResult
        ]);
    }




    public function getStudentProfile($studentId)
    {
        $student = Student::find($studentId);
        return view('pages.studentdashboard', compact('student'));
    }














}
