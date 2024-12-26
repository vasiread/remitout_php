<?php

namespace App\Http\Controllers;

use App\Models\Academics;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use App\Models\PersonalInfo;
use App\Models\CourseInfo;

class StudentDashboardController extends Controller
{
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
        return view('pages.studentdashboard', compact('user', 'userDetails', $userDetails, 'personalDetails', $personalDetails, 'courseDetails', $courseDetails, 'academicDetails', $academicDetails));
    }
    public function updateFromProfile(Request $request)
    {
        $validated = $request->validate([
            'editedName' => 'required|string|max:255',
            'editedPhone' => 'required|string|max:15',
            'editedEmail' => 'required|email',
            'editedState' => 'required|string|max:255',
            'iletsScore' => 'required|numeric',
            'greScore' => 'required|numeric',
            'tofelScore' => 'required|numeric',

            'planToStudy' => 'required',
            'courseDuration' => 'required|numeric',
            'loanAmount' => 'required|numeric',
            'referralCode' => 'required|string',
            'userId' => 'required'
        ]);

        // Find the user by unique_id
        $user = User::where('unique_id', $validated['userId'])->first();

        if ($user) {
            // Update the User model's name and email
            $user->name = $validated['editedName'];
            $user->email = $validated['editedEmail'];
            $user->save();
            $personalInfo = PersonalInfo::where('user_id', $user->unique_id)->first();

            if ($personalInfo) {
                $personalInfo->phone = $validated['editedPhone'];
                $personalInfo->state = $validated['editedState'];
                $personalInfo->full_name = $validated['editedName'];
                $personalInfo->referral_code = $validated['referralCode'];
                $personalInfo->save();
            } else {
                $personalInfo = PersonalInfo::create([
                    'user_id' => $user->unique_id,
                    'full_name' => $validated['editedName'],
                    'phone' => $validated['editedPhone'],
                    'state' => $validated['editedState'],
                    'referral_code' => $validated['referralCode']
                ]);
            }

            $academicsScores = Academics::where('user_id', $user->unique_id)->first();

            if ($academicsScores) {
                $academicsScores->ILETS = $validated['iletsScore'];
                $academicsScores->GRE = $validated['greScore'];
                $academicsScores->TOFEL = $validated['tofelScore'];
                $academicsScores->save();
            } else {
                $academicsScores = Academics::create([
                    'user_id' => $user->unique_id,
                    'ILETS' => $validated['iletsScore'],
                    'GRE' => $validated['greScore'],
                    'TOFEL' => $validated['tofelScore'],
                ]);

            }




            $courseInfoData = CourseInfo::where('user_id', $user->unique_id)->first();



            $planToStudy = is_array($validated['planToStudy'])
                ? json_encode($validated['planToStudy'])
                : json_encode(explode(',', $validated['planToStudy']));


            if ($courseInfoData) {
                $courseInfoData->{"plan-to-study"} = $planToStudy;
                $courseInfoData->{"course-duration"} = $validated['courseDuration'];
                $courseInfoData->loan_amount_in_lakhs = $validated['loanAmount'];
                $courseInfoData->save();
            } else {
                $courseInfoData = CourseInfo::create([
                    'user_id' => $user->unique_id,
                    'plan-to-study' => $planToStudy,
                    'course-duration' => $validated['courseDuration'],
                    'loan_amount_in_lakhs' => $validated['loanAmount'],
                ]);

            }


            $user->refresh();
            $personalInfo->refresh();
            $academicsScores->refresh();
            $courseInfoData->refresh();

            return response()->json([
                'message' => 'User details updated successfully.',
                'user' => $user,
                'personalInfo' => $personalInfo,
                'academicsScores' => $academicsScores
            ], 200);
        } else {
            return response()->json(['message' => 'User not found.'], 404);
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
        // Validate the incoming request
        $request->validate([
            'userId' => 'required|string',
        ]);

        // Retrieve user ID
        $userId = $request->input('userId');

        // Define the file path for the profile pictures folder
        $filePath = "$userId/profile_pictures";  // Assuming profile pictures are stored in this structure

        // Get the list of files in the user's profile pictures directory
        $files = Storage::disk('s3')->files($filePath);

        // Check if there are any files (there should be one per user)
        if (!empty($files)) {
            $file = $files[0];  // Get the first file (we expect only one profile picture per user)

            // Generate the URL of the file
            $fileUrl = Storage::disk('s3')->url($file);

            return response()->json([
                'message' => 'Profile picture retrieved successfully.',
                'fileUrl' => $fileUrl,  // This is the actual S3 URL
            ], 200);
        }

        // If no profile picture exists for the user, return an error message
        return response()->json([
            'message' => 'No profile picture found for this user.',
        ], 404);
    }
    public function aadharCardView(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'userId' => 'required|string',
        ]);

        // Retrieve user ID
        $userId = $request->input('userId');

        // Define the file path for the profile pictures folder
        $filePath = "$userId/aadhar-card-name";  // Assuming profile pictures are stored in this structure

        // Get the list of files in the user's profile pictures directory
        $files = Storage::disk('s3')->files($filePath);

        // Check if there are any files (there should be one per user)
        if (!empty($files)) {
            $file = $files[0];  // Get the first file (we expect only one profile picture per user)

            // Generate the URL of the file
            $fileUrl = Storage::disk('s3')->url($file);

            return response()->json([
                'message' => 'Aadhar Card Url retrieved successfully.',
                'fileUrl' => $fileUrl,  // This is the actual S3 URL
            ], 200);
        }

        // If no profile picture exists for the user, return an error message
        return response()->json([
            'message' => 'No profile picture found for this user.',
        ], 404);
    }
    public function passportView(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'userId' => 'required|string',
        ]);

        // Retrieve user ID
        $userId = $request->input('userId');

        // Define the file path for the profile pictures folder
        $filePath = "$userId/pan-card-name";  // Assuming profile pictures are stored in this structure

        // Get the list of files in the user's profile pictures directory
        $files = Storage::disk('s3')->files($filePath);

        // Check if there are any files (there should be one per user)
        if (!empty($files)) {
            $file = $files[0];  // Get the first file (we expect only one profile picture per user)

            // Generate the URL of the file
            $fileUrl = Storage::disk('s3')->url($file);

            return response()->json([
                'message' => 'Pan Card URL retrieved successfully.',
                'fileUrl' => $fileUrl,  // This is the actual S3 URL
            ], 200);
        }

        // If no profile picture exists for the user, return an error message
        return response()->json([
            'message' => 'No profile picture found for this user.',
        ], 404);
    }
    public function pancardView(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'userId' => 'required|string',
        ]);

        // Retrieve user ID
        $userId = $request->input('userId');

        // Define the file path for the profile pictures folder
        $filePath = "$userId/passport-name";  // Assuming profile pictures are stored in this structure

        // Get the list of files in the user's profile pictures directory
        $files = Storage::disk('s3')->files($filePath);

        // Check if there are any files (there should be one per user)
        if (!empty($files)) {
            $file = $files[0];  // Get the first file (we expect only one profile picture per user)

            // Generate the URL of the file
            $fileUrl = Storage::disk('s3')->url($file);

            return response()->json([
                'message' => 'Passport URL retrieved successfully.',
                'fileUrl' => $fileUrl,  // This is the actual S3 URL
            ], 200);
        }

        // If no profile picture exists for the user, return an error message
        return response()->json([
            'message' => 'No profile picture found for this user.',
        ], 404);
    }
    public function sslcmarksheetView(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'userId' => 'required|string',
        ]);

        // Retrieve user ID
        $userId = $request->input('userId');

        // Define the file path for the profile pictures folder
        $filePath = "$userId/tenth-grade-name";  // Assuming profile pictures are stored in this structure

        // Get the list of files in the user's profile pictures directory
        $files = Storage::disk('s3')->files($filePath);

        // Check if there are any files (there should be one per user)
        if (!empty($files)) {
            $file = $files[0];  // Get the first file (we expect only one profile picture per user)

            // Generate the URL of the file
            $fileUrl = Storage::disk('s3')->url($file);

            return response()->json([
                'message' => '10th marksheet URL retrieved successfully.',
                'fileUrl' => $fileUrl,  // This is the actual S3 URL
            ], 200);
        }

        // If no profile picture exists for the user, return an error message
        return response()->json([
            'message' => 'No profile picture found for this user.',
        ], 404);
    }
    public function hscmarksheetView(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'userId' => 'required|string',
        ]);

        // Retrieve user ID
        $userId = $request->input('userId');

        // Define the file path for the profile pictures folder
        $filePath = "$userId/twelfth-grade-name";  // Assuming profile pictures are stored in this structure

        // Get the list of files in the user's profile pictures directory
        $files = Storage::disk('s3')->files($filePath);

        // Check if there are any files (there should be one per user)
        if (!empty($files)) {
            $file = $files[0];  // Get the first file (we expect only one profile picture per user)

            // Generate the URL of the file
            $fileUrl = Storage::disk('s3')->url($file);

            return response()->json([
                'message' => '12th Marksheet retrieved successfully.',
                'fileUrl' => $fileUrl,  // This is the actual S3 URL
            ], 200);
        }

        // If no profile picture exists for the user, return an error message
        return response()->json([
            'message' => 'No profile picture found for this user.',
        ], 404);
    }
    public function graduationmarksheetView(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'userId' => 'required|string',
        ]);

        // Retrieve user ID
        $userId = $request->input('userId');

        // Define the file path for the profile pictures folder
        $filePath = "$userId/graduation-grade-name";  // Assuming profile pictures are stored in this structure

        // Get the list of files in the user's profile pictures directory
        $files = Storage::disk('s3')->files($filePath);

        // Check if there are any files (there should be one per user)
        if (!empty($files)) {
            $file = $files[0];  // Get the first file (we expect only one profile picture per user)

            // Generate the URL of the file
            $fileUrl = Storage::disk('s3')->url($file);

            return response()->json([
                'message' => 'Graduation Marksheet URL retrieved successfully.',
                'fileUrl' => $fileUrl,  // This is the actual S3 URL
            ], 200);
        }

        // If no profile picture exists for the user, return an error message
        return response()->json([
            'message' => 'No profile picture found for this user.',
        ], 404);
    }





}
