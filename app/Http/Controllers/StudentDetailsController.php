<?php

namespace App\Http\Controllers;

use App\Models\Academics;
use App\Models\CoBorrowerInfo;
use App\Models\CourseInfo;
use App\Models\PersonalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;



class StudentDetailsController extends Controller
{
    public function updatePersonalInfo(Request $request)
    {
        try {
            Log::info($request->all());

            $personalInfoDetail = PersonalInfo::find($request->personalInfoId);


            if (!$personalInfoDetail) {
                return response()->json(['success' => false, 'message' => 'User not found.']);
            }

            $personalInfoDetail->full_name = $request->input('personalInfoName');
            $personalInfoDetail->phone = $request->input('personalInfoPhone');
            $personalInfoDetail->referral_code = $request->input('personalInfoReferral');
            $personalInfoDetail->email = $request->input('personalInfoEmail');
            $personalInfoDetail->state = $request->input('personalInfoCity');
            $personalInfoDetail->linked_through = $request->input('personalInfoFindOut');

            $personalInfoDetail->save();

            return response()->json(['success' => true, 'message' => 'Your details have been updated successfully.']);
        } catch (\Exception $e) {
            Log::error('Error updating personal info: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'An error occurred while updating your details.']);
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
        $personalInfoId = $request->personalInfoId;

        // Validate that personalInfoId is provided
        if ($personalInfoId === '') {
            return response()->json(['success' => false, 'message' => 'personalInfoId is required']);
        }



        try {
            $existingPersonalInfo = PersonalInfo::where('user_id', $personalInfoId)->first();
            $existingCourseInfo = CourseInfo::where('user_id', $personalInfoId)->first();
            $existingAcademics = Academics::where('user_id', $personalInfoId)->first();
            $existingCoborrwer = CoBorrowerInfo::where('user_id', $personalInfoId)->first();

            session(['existing_personal_info' => $existingPersonalInfo]);


            if (!$existingPersonalInfo && !$existingCourseInfo && !$existingAcademics && !$existingCoborrwer) {
                // If no records exist with the same user_id, create new records
                $personalInfoDetail = PersonalInfo::create([
                    'user_id' => $personalInfoId,
                ]);

                $courseInfoDetail = CourseInfo::create([
                    'user_id' => $personalInfoId,
                ]);

                $AcademicsDetail = Academics::create([
                    'user_id' => $personalInfoId,
                ]);
                $CoborrowerDetail = CoBorrowerInfo::create([
                    'user_id' => $personalInfoId,
                ]);
            } else {
                // If any of the records already exist with the same user_id
                return response()->json(['message' => 'User ID already exists in one of the tables.'], 400);
            }

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }

        return response()->json(['success' => true, 'message' => $personalInfoId]);
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
