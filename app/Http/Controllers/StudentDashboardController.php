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
                $personalInfo->save();
            } else {
                $personalInfo = PersonalInfo::create([
                    'user_id' => $user->unique_id,
                    'full_name' => $validated['editedName'],
                    'phone' => $validated['editedPhone'],
                    'state' => $validated['editedState']
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


            $user->refresh();
            $personalInfo->refresh();
            $academicsScores->refresh();

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





    public function uploadProfilePicture(Request $request)
    {
        // Validate the file input
        $request->validate([
            'file' => 'required|file',
        ]);

        try {
            // Get the file from the request
            $file = $request->file('file');

            // Generate a unique file name with the extension
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Define the folder in S3 bucket
            $folder = 'uploads/';

            // Upload the file to S3
            $filePath = $folder . $fileName;
            $uploadSuccess = Storage::disk('s3')->put($filePath, file_get_contents($file), 'public');

            // Check if the upload was successful
            if ($uploadSuccess) {
                $fileUrl = Storage::disk('s3')->url($filePath);
                info("File successfully uploaded to: " . $fileUrl);
                return response()->json(['url' => $fileUrl], 200);
            } else {
                info("File upload failed");
                return response()->json(['error' => 'Failed to upload file'], 500);
            }
        } catch (\Exception $e) {
            // Log the exception for debugging
            info("Upload Error: " . $e->getMessage());
            return response()->json(['error' => 'File upload error: ' . $e->getMessage()], 500);
        }
    }







}
