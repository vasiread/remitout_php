<?php
namespace App\Http\Controllers;

use App\Mail\SendScDetailsMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
    public function getUsersByCounsellorApi(Request $request)
    {
        $request->validate([
            'referralId' => 'string|required'
        ]);

        $referralId = $request->input('referralId');



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

    public function uploadScUserInfo(Request $request)
    {
        $request->validate([
            'scUserName' => 'string|required',
            'scDob' => 'string|required',
            'scEmail' => 'string|required|email',
            'scContact' => 'string|required',
            'scAddress' => 'string|required',
            'profilePhoto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $password = Str::random(12);
            $hashedPassword = Hash::make($password);

            $referralCode = 'SCREF' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
            while (Scuser::where('referral_code', $referralCode)->exists()) {
                $referralCode = 'SCREF' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
            }

            $scUser = Scuser::create([
                'referral_code' => $referralCode,
                'full_name' => $request->input('scUserName'),
                'dob' => $request->input('scDob'),
                'email' => $request->input('scEmail'),
                'phone' => $request->input('scContact'),
                'address' => $request->input('scAddress'),
                'passwordField' => $hashedPassword
            ]);

            $fileUrl = null;

            if ($scUser) {
                if ($request->hasFile('profilePhoto')) {
                    $file = $request->file('profilePhoto');
                    $fileName = $file->getClientOriginalName();
                    $fileDirectory = "Student_Counsellor/$referralCode/Profile_photoes";


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

                    $fileUrl = Storage::disk('s3')->url($filePath); // Get the file URL
                }

                Mail::to($request->input('scEmail'))->send(new SendScDetailsMail($referralCode, $password));
            }

            return response()->json([
                'message' => 'User information successfully uploaded and password sent!',
                'scUser' => $scUser,
                'profilePhoto' => $fileUrl
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }


    public function retrieveOneScUser(Request $request)
    {

        $request->validate([
            'referral_code' => 'required|string'
        ]);

        $scuser = Scuser::where('referral_code', $request->input("referral_code"))->first();

        return $scuser;


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


    public function uploadScUserDetails(Request $request)
    {
        $request->validate([
            'scRefNo' => 'required|string',
            'updatedScName' => 'nullable|string', // Make nullable for optional fields
            'updatedScDob' => 'nullable|string',
            'updatedScPhone' => 'nullable|string',
            'finalAddress' => 'nullable|string',
        ]);

        try {
            $studentCounsellor = Scuser::where('referral_code', $request->input('scRefNo'))->first();

            if ($studentCounsellor) {
                if ($request->has('updatedScName')) {
                    $studentCounsellor->full_name = $request->input('updatedScName');
                }
                if ($request->has('updatedScDob')) {
                    $studentCounsellor->dob = $request->input('updatedScDob');
                }
                if ($request->has('updatedScPhone')) {
                    $studentCounsellor->phone = $request->input('updatedScPhone');
                }
                if ($request->has('finalAddress')) {
                    $studentCounsellor->address = $request->input('finalAddress');
                }

                // Save the updated data
                $studentCounsellor->save();

                // Update the session with the new data


                return response()->json([
                    'success' => true,
                    'message' => 'Student counsellor details updated successfully',
                ], 200);
            } else {
                return response()->json([
                    'error' => 'Student counsellor not found',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while updating the details.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }




}
