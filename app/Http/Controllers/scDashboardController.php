<?php
namespace App\Http\Controllers;

use App\Models\PersonalInfo;
use App\Models\Scuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class scDashboardController extends Controller
{

    public function getUsersByCounsellor()
    {
        $referralId = "HYU67994003";

        $userByRef = PersonalInfo::where('referral_code', $referralId)->get();
        $scDetail = Scuser::where('referral_code', $referralId)->get();

        if ($userByRef->isEmpty() || $scDetail->isEmpty()) {
            return response()->json([
                'error' => 'No users found for the given referral code.',
                'referral_code' => $referralId,
                'users_found' => false
            ], 404);
        }

        return $userByRef;
    }

    public function uploadScUserPhoto(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,gif|max:2048',  // Validate file type and size (2MB max)
            'scuserrefid' => 'required|string',
        ]);

        $screfId = $request->input('scuserrefid');

        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = $file->getClientOriginalName();
                $fileDirectory = "Student_Counsellor/$screfId/Profile_photoes";

                // Delete existing files in the directory
                $existingFiles = Storage::disk('s3')->files($fileDirectory);
                if (!empty($existingFiles)) {
                    Storage::disk('s3')->delete($existingFiles);
                }

                // Store the new file
                $filePath = $file->storeAs(
                    $fileDirectory,
                    $fileName,
                    [
                        'disk' => 's3',
                        'visibility' => 'public',
                    ]
                );

                // Retrieve the file's public URL
                $fileUrl = Storage::disk('s3')->url($filePath);

                return response()->json([
                    'message' => 'File uploaded successfully!',
                    'file_name' => $fileName,
                    'file_path' => $fileUrl,
                ], 200);
            }

            return response()->json([
                'message' => 'No file uploaded.',
            ], 400);
        } catch (\Exception $e) {
             \Log::error('Error uploading file: ' . $e->getMessage());

            return response()->json([
                'message' => 'File upload failed.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function retrieveScProfilePicture(Request $request)
    {
        $request->validate([
            'scuserrefid' => 'required|string',
        ]);

        $scuserrefid = $request->input('scuserrefid');

        $filePath = "Student_Counsellor/$scuserrefid/Profile_photoes";

        $files = Storage::disk('s3')->files($filePath);

        if (!empty($files)) {
            $file = $files[0];

            $fileUrl = Storage::disk('s3')->url($file);

            return response()->json([
                'message' => 'Profile picture retrieved successfully.',
                'fileUrl' => $fileUrl,   
            ], 200);
        }

        return response()->json([
            'message' => 'No profile picture found for this user.',
        ], 404);
    }



}
