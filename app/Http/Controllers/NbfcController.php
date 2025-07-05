<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Mail\SendScDetailsMail;
use App\Models\Admin;
use App\Models\Nbfc;
use App\Models\Proposals;
use App\Models\Requestprogress;
use App\Models\Scuser;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Storage;

class NbfcController extends Controller
{
    public function addBulkNbfc(Request $request)
    {
        $nbfcUsers = $request->all();
        $errors = [];
        $successCount = 0;

 
        foreach ($nbfcUsers as $index => $user) {
            $email = $user['email'];

            // Check if email exists in SUPERADMIN or any DB model
            $emailExists =
                $email ===  
                User::where('email', $email)->exists() ||
                Nbfc::where('nbfc_email', $email)->exists() ||
                Scuser::where('email', $email)->exists() ||
                Admin::where('email', $email)->exists();

            if ($emailExists) {
                $errors[$index][] = "$email already exists.";
                continue;
            }

            // Validate fields
            $validator = Validator::make($user, [
                'name' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                $errors[$index] = $validator->errors()->all();
                continue;
            }

            try {
                $password = Str::random(12);
                $hashedPassword = Hash::make($password);

                $nbfcId = 'NBFC' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
                while (Nbfc::where('nbfc_id', $nbfcId)->exists()) {
                    $nbfcId = 'NBFC' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
                }

                $nbfcUser = new Nbfc();
                $nbfcUser->nbfc_id = $nbfcId;
                $nbfcUser->nbfc_email = $email;
                $nbfcUser->password = $hashedPassword;
                $nbfcUser->nbfc_name = $user['name'];
                $nbfcUser->nbfc_description = $user['description'] ?? null;
                $nbfcUser->nbfc_type = $user['type'];

                if ($nbfcUser->save()) {
                    Mail::to($email)->send(new SendScDetailsMail($nbfcId, $password));
                    $successCount++;
                }
            } catch (\Exception $e) {
                \Log::error("Failed to create NBFC user at index $index: " . $e->getMessage());
                $errors[$index][] = 'An error occurred: ' . $e->getMessage();
            }
        }

        if (!empty($errors)) {
            return response()->json([
                'success' => false,
                'errors' => $errors,
                'processed_successfully' => $successCount,
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => "$successCount user(s) registered successfully!"
        ]);
    }



    public function sendProposalsWithFiles(Request $request)
    {
        // Step 1: Validate the incoming request
        $request->validate([
            'file' => 'required|file',
            'userId' => 'required|string',
            'nbfcId' => 'required|string',
            'remarks' => 'required|string',
        ]);

        $userId = $request->input('userId');
        $nbfcId = $request->input('nbfcId');
        $remarks = $request->input('remarks');

        $file = $request->file('file');
        $fileDirectory = "ProposalDocuments By Nbfc's/$userId/$nbfcId"; // Folder for user files

        // Step 2: Delete any existing files for this user/NBFC combo
        $existingFiles = Storage::disk('s3')->files($fileDirectory);
        if (!empty($existingFiles)) {
            foreach ($existingFiles as $existingFile) {
                Storage::disk('s3')->delete($existingFile);
            }
        }

        try {
            // Step 3: Upload the new file
            $fileName = time() . '-' . $file->getClientOriginalName();
            $filePath = $file->storeAs(
                $fileDirectory,
                $fileName,
                [
                    'disk' => 's3',
                    'visibility' => 'public', // Make it public if needed
                ]
            );

            $fileUrl = Storage::disk('s3')->url($filePath);

            // Step 4: Update progress
            Requestprogress::where('user_id', $userId)
                ->where('nbfc_id', $nbfcId)
                ->update(['type' => Requestprogress::TYPE_PROPOSAL]);

            // Step 5: Update or create proposal
            Proposals::updateOrCreate(
                [
                    'student_id' => $userId,
                    'nbfc_id' => $nbfcId,
                ],
                [
                    'remarks' => $remarks,
                    'status_modified_by_students' => Proposals::PENDING,
                ]
            );

            // Step 6: Return response
            return response()->json([
                'message' => 'Proposal Sent Successfully!',
                'file_name' => $fileName,
                'file_path' => $fileUrl,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to upload file',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getProposalFileUrl(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'userId' => 'required|string',
            'nbfcId' => 'required|string'
        ]);

        $userId = $request->input('userId');
        $nbfcId = $request->input('nbfcId');

        // Build the directory path
        $fileDirectory = "ProposalDocuments By Nbfc's/$userId/$nbfcId";

        try {
            // Get all files from the directory (there should typically be only one due to earlier deletion logic)
            $files = Storage::disk('s3')->files($fileDirectory);

            if (empty($files)) {
                return response()->json(['message' => 'No file found for this user and NBFC'], 404);
            }

            // Assuming there's only one file
            $filePath = $files[0];

            // Generate public URL
            $fileUrl = Storage::disk('s3')->url($filePath);

            return response()->json([
                'file_name' => basename($filePath),
                'file_path' => $fileUrl
            ]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve file', 'error' => $e->getMessage()], 500);
        }
    }


    public function forgotNbfcCredential(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        Log::info('Requested email: ' . $request->email);


        $user = Nbfc::where('nbfc_email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $newPassword = Str::random(10);

        if ($user->password !== Hash::make($newPassword)) {
            $user->password = Hash::make($newPassword);  // Encrypt password before saving
            $user->save();

            Mail::to($user->nbfc_email)->send(new ForgotPassword(
                $user->nbfc_email,
                $user->nbfc_id,
                $newPassword
            ));

            return response()->json(['message' => 'A new password has been sent to your email.']);
        } else {
            return response()->json(['message' => 'The password has not changed.']);
        }
    }



    public function updateReviewStatus(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|string',
                'nbfc_id' => 'required|string',
            ]);

            $updated = Requestprogress::where('user_id', $request->user_id)
                ->where('nbfc_id', $request->nbfc_id)
                ->where('type', Requestprogress::TYPE_REQUEST)
                ->update(['reviewed' => 1]);

            if ($updated) {
                return response()->json(['success' => true, 'message' => 'Review status updated.']);
            } else {
                return response()->json(['success' => false, 'message' => 'No matching request found.']);
            }
        } catch (\Exception $e) {
            Log::error('Update Review Status Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }







}
