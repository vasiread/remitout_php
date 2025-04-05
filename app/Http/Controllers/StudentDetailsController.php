<?php

namespace App\Http\Controllers;

use App\Models\Academics;
use App\Models\CoBorrowerInfo;
use App\Models\CourseInfo;
use App\Models\PersonalInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;



class StudentDetailsController extends Controller
{
    public function updatePersonalInfo(Request $request)
    {
        try {
            // Log the request input
            Log::info('Request received:', $request->all());

            // Fetch the personal info and user models
            $personalInfoDetail = PersonalInfo::find($request->personalInfoId);
            $user = User::where('unique_id', $request->personalInfoId)->first();

            // Check if either is missing
            if (!$personalInfoDetail || !$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found.'
                ]);
            }

            // Log the user object safely
            Log::info('User found:', ['user' => $user]);

            // Update fields
            $personalInfoDetail->full_name = $request->input('personalInfoName');
            $personalInfoDetail->referral_code = $request->input('personalInfoReferral');
            $personalInfoDetail->email = $request->input('personalInfoEmail');
            $personalInfoDetail->state = $request->input('personalInfoCity');
            $personalInfoDetail->linked_through = $request->input('personalInfoFindOut');

            $user->referral_code = $request->input('personalInfoReferral');

            // Save both
            $personalInfoDetail->save();
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Your details have been updated successfully.'
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating personal info: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating your details.'
            ]);
        }
    }

    public function updateCourseInfo(Request $request)
    {
        try {
            Log::info($request->all());

            $courseInfoDetail = CourseInfo::find($request->personalInfoId);


            if (!$courseInfoDetail) {
                return response()->json(['success' => false, 'message' => 'User not found.']);
            }
            $courseInfoDetail->{'plan-to-study'} = $request->input('studyLocations');
            $courseInfoDetail->{'degree-type'} = $request->input('selectedDegreeType');
            $courseInfoDetail->{'course-duration'} = $request->input('courseDuration');

            $courseInfoDetail->{'course-details'} = $request->input('expenseType');
            $courseInfoDetail->loan_amount_in_lakhs = $request->input('loanAmount');

            $courseInfoDetail->save();

            return response()->json(['success' => true, 'message' => 'Your details have been updated successfully.']);
        } catch (\Exception $e) {
            Log::error('Error updating personal info: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'An error occurred while updating your details.']);
        }
    }

    public function updateUserIds(Request $request)
    {
        // Validate that personalInfoId is provided
        $request->validate([
            'personalInfoId' => 'required',
        ]);

        $personalInfoId = $request->personalInfoId;

        try {
            // Retrieve existing records
            $existingPersonalInfo = PersonalInfo::where('user_id', $personalInfoId)->first();
            $existingCourseInfo = CourseInfo::where('user_id', $personalInfoId)->first();
            $existingAcademics = Academics::where('user_id', $personalInfoId)->first();
            $existingCoborrwer = CoBorrowerInfo::where('user_id', $personalInfoId)->first();

            session(['existing_personal_info' => $existingPersonalInfo]);

            // Check if PersonalInfo exists or not
            if (!$existingPersonalInfo) {
                // Create PersonalInfo if it doesn't exist
                $personalInfoDetail = PersonalInfo::create([
                    'user_id' => $personalInfoId,
                ]);
            }

            // Check if CourseInfo, Academics, and CoBorrowerInfo exist, and create them if not
            if (!$existingCourseInfo) {
                $courseInfoDetail = CourseInfo::create([
                    'user_id' => $personalInfoId,
                ]);
            }

            if (!$existingAcademics) {
                $academicsDetail = Academics::create([
                    'user_id' => $personalInfoId,
                ]);
            }

            if (!$existingCoborrwer) {
                $coBorrowerDetail = CoBorrowerInfo::create([
                    'user_id' => $personalInfoId,
                ]);
            }

            // Return success response
            return response()->json(['success' => true, 'message' => 'Data updated or created successfully.']);

        } catch (\Exception $e) {
            // Handle any exceptions
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }


    public function updateAcademicsInfo(Request $request)
    {
        try {
            Log::info($request->all());

            $academicsDetailsInfo = Academics::find($request->personalInfoId);


            if (!$academicsDetailsInfo) {
                return response()->json(['success' => false, 'message' => 'User not found.']);
            }
            $academicsDetailsInfo->gap_in_academics = $request->input('selectedAcademicGap');
            $academicsDetailsInfo->reason_for_gap = $request->input('reasonForGap');
            $academicsDetailsInfo->work_experience = $request->input('selectedWorkOption');

            $academicsDetailsInfo->ILETS = $request->input('ieltsScore');
            $academicsDetailsInfo->GRE = $request->input('greScore');
            $academicsDetailsInfo->TOFEL = $request->input('toeflScore');
            $academicsDetailsInfo->Others = $request->input('others');
            $academicsDetailsInfo->university_school_name = $request->input("universityName");
            $academicsDetailsInfo->course_name = $request->input("courseName");


            $academicsDetailsInfo->save();

            return response()->json(['success' => true, 'message' => 'Your details have been updated successfully.']);
        } catch (\Exception $e) {
            Log::error('Error updating personal info: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'An error occurred while updating your details.']);
        }
    }



    public function updateCoborrowerInfo(Request $request)
    {
        try {
            // Log incoming request data for debugging
            Log::info('Request data:', $request->all());

            // Find the co-borrower info by user_id
            $coBorrowerInfo = CoBorrowerInfo::where('user_id', $request->personalInfoId)->first();

            if (!$coBorrowerInfo) {
                return response()->json(['success' => false, 'message' => 'Co-borrower information not found'], 404);
            }

            // Update co-borrower information fields
            $coBorrowerInfo->co_borrower_relation = $request->input('answer');
            $coBorrowerInfo->co_borrower_income = $request->input('incomeValue');
            $coBorrowerInfo->liability_select = $request->input('selectedLiability');
            $coBorrowerInfo->co_borrower_monthly_liability = $request->input('emiAmount');

            // Save the updated information
            $coBorrowerInfo->save();

            // Return success response
            return response()->json(['success' => true, 'message' => 'Your details have been updated successfully.'], 200);

        } catch (\Exception $e) {
            // Log the error with the stack trace for detailed debugging
            Log::error('Error updating co-borrower info: ' . $e->getMessage(), ['exception' => $e]);

            // Return error response with detailed message (only in development environment)
            $errorMessage = env('APP_DEBUG') ? $e->getMessage() : 'An error occurred while updating your details.';

            return response()->json(['success' => false, 'message' => $errorMessage], 500);
        }
    }




}
