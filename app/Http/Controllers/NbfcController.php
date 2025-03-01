<?php

namespace App\Http\Controllers;

use App\Mail\SendScDetailsMail;
use App\Models\Nbfc;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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




}
