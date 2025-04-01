<?php

namespace App\Http\Controllers;

use App\Mail\SendScDetailsMail;
use App\Models\Nbfc;
use App\Models\Proposals;
use App\Models\Requestprogress;
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
        $successCount = 0; // Counter to track successful users

        foreach ($nbfcUsers as $index => $user) {
            $validator = Validator::make($user, [
                'name' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'email' => 'required|email|max:255|email|unique:nbfc,nbfc_email',
                'description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                $errors[$index] = $validator->errors()->all();
                continue;
            }

            try {
                $password = Str::random(12);
                $hashedPassword = Hash::make($password);

                // Generate a unique nbfc_id
                $nbfcId = 'NBFC' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
                while (Nbfc::where('nbfc_id', $nbfcId)->exists()) {
                    $nbfcId = 'NBFC' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
                }

                // Create new NBFC user
                $nbfcUser = new Nbfc();
                $nbfcUser->nbfc_id = $nbfcId;
                $nbfcUser->nbfc_email = $user['email'];
                $nbfcUser->password = $hashedPassword;
                $nbfcUser->nbfc_name = $user['name'];
                $nbfcUser->nbfc_description = $user['description'] ?? null;
                $nbfcUser->nbfc_type = $user['type'];
                $isSaved = $nbfcUser->save();

                if ($isSaved) {
                    // Send email after saving the user
                    $referralCode = $nbfcId;
                    Mail::to($user['email'])->send(new SendScDetailsMail($referralCode, $password));
                    $successCount++;
                }

            } catch (\Exception $e) {
                // Log any exception errors
                $errors[$index] = 'An error occurred: ' . $e->getMessage();
                continue; // Continue to the next user in case of failure
            }
        }

        // Return response based on success/failure
        if (!empty($errors)) {
            return response()->json([
                'success' => false,
                'errors' => $errors,
                'processed_successfully' => $successCount,
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => "$successCount users registered successfully!",
        ], 200);
    }

    public function sendProposalsWithFiles(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'file' => 'required|file',
            'userId' => 'required|string',
            'nbfcId' => 'required|string',
            'remarks' => 'string'
        ]);

        $userId = $request->input('userId');
        $nbfcId = $request->input('nbfcId');
        $remarks = $request->input('remarks');
        $fileDirectory = "ProposalDocuments By Nbfc's/$userId"; // Folder name for each user
        $file = $request->file('file');

        // Check if a file is uploaded
        if (!$file) {
            return response()->json(['message' => 'No file uploaded'], 400);
        }

        // Generate a unique file name to avoid overwriting files
        $fileName = time() . '-' . $file->getClientOriginalName();

        // Check for existing files in the folder for this user and delete them
        $existingFiles = Storage::disk('s3')->files($fileDirectory);

        // Delete existing files in the user folder if any (only the files for this user, not other users)
        if (!empty($existingFiles)) {
            foreach ($existingFiles as $existingFile) {
                // Delete the existing files for the user
                Storage::disk('s3')->delete($existingFile);
            }
        }

        try {
            // Perform update to progress
            $updateSuccess = Requestprogress::where('user_id', $userId)
                ->where('nbfc_id', $nbfcId)
                ->update(['type' => 'proposal']);
            $pushProposalTable = Proposals::updateOrCreate(
                [
                    'student_id' => $userId,
                    'nbfc_id' => $nbfcId
                ],
                [
                    'remarks' => $remarks,
                    'status_modified_by_students' => Proposals::PENDING
                ]
            );

            if ($updateSuccess && $pushProposalTable) {
                $filePath = $file->storeAs(
                    $fileDirectory,
                    $fileName,
                    [
                        'disk' => 's3',
                        'visibility' => 'public', // Make it public
                    ]
                );

                // Get the URL for the uploaded file
                $fileUrl = Storage::disk('s3')->url($filePath);

                // Return the success response with file details
                return response()->json([
                    'message' => 'Proposal Sent Successfully!',
                    'file_name' => $fileName,
                    'file_path' => $fileUrl,
                ]);
            } else {
                // Handle failure to update progress
                return response()->json(['message' => 'Failed to update progress'], 500);
            }

        } catch (\Exception $e) {
            // Handle error during file upload
            return response()->json(['message' => 'Failed to upload file', 'error' => $e->getMessage()], 500);
        }
    }





}
