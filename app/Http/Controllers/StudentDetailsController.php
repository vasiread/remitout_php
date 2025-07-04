<?php

namespace App\Http\Controllers;
use App\Models\Academics;
use App\Models\AdditionalField;
use App\Models\CoBorrowerInfo;
use App\Models\CourseInfo;
use App\Models\DocumentType;
use App\Models\PersonalInfo;
use App\Models\User;
use App\Models\UserAdditionalFieldValue;
use App\Models\UserDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;



class StudentDetailsController extends Controller
{
    public function updatePersonalInfo(Request $request)
    {
        try {
            Log::info('updatePersonalInfo called:', $request->all());

            // First find the user via unique_id
            $user = User::where('unique_id', $request->personalInfoId)->first();

            if (!$user) {
                Log::warning('User not found.', ['unique_id' => $request->personalInfoId]);
                return response()->json([
                    'success' => false,
                    'message' => 'User not found.'
                ]);
            }

            // Now get the corresponding personal info
            $personalInfoDetail = PersonalInfo::where('user_id', $user->unique_id)->first();

            if (!$personalInfoDetail) {
                Log::warning('PersonalInfo not found for user.', ['user_id' => $user->id]);
                return response()->json([
                    'success' => false,
                    'message' => 'Personal info not found.'
                ]);
            }

            // Update fields
            $personalInfoDetail->full_name = $request->input('personalInfoName');
            $personalInfoDetail->gender = $request->input('genderOptions');
            $personalInfoDetail->dob = $request->input('personalInfoDob');
            $personalInfoDetail->referral_code = $request->input('personalInfoReferral');
            $personalInfoDetail->email = $request->input('personalInfoEmail');
            $personalInfoDetail->city = $request->input('personalInfoCity');
            $personalInfoDetail->state = $request->input('personalInfoState');
            $personalInfoDetail->linked_through = $request->input('personalInfoFindOut');

            $user->email = $request->input('personalInfoEmail');
            $user->referral_code = $request->input('personalInfoReferral');

            // Handle dynamic fields
            if ($request->has('dynamic_fields')) {
                foreach ($request->input('dynamic_fields') as $fieldId => $value) {
                    if (empty($value) && $value !== '0') continue;

                    $valueToSave = is_array($value) ? json_encode($value) : $value;

                    UserAdditionalFieldValue::updateOrCreate(
                        ['user_id' => $user->id, 'field_id' => $fieldId],
                        ['value' => $valueToSave]
                    );
                }
            }

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
            Log::info('updateCourseInfo called:', $request->all());

            $courseInfoDetail = CourseInfo::find($request->personalInfoId);
            // Update static course fields from the request if present
            $courseInfoDetail->fill([
                'plan-to-study'        => $request->input('plan_to_study'),
                'degree-type'          => $request->input('degree_type'),
                'course-duration'      => $request->input('course_duration'),
                'course-details'       => $request->input('course_details'),
                'loan-amount-in-lakhs' => $request->input('loan_amount_in_lakhs'),
            ]);



            $user = User::where('unique_id', $request->personalInfoId)->first();

            if (!$courseInfoDetail || !$user) {
                Log::warning('User or CourseInfo not found.', ['personalInfoId' => $request->personalInfoId]);
                return response()->json(['success' => false, 'message' => 'User not found.']);
            }

            // Update course fields...

            if ($request->has('dynamic_fields')) {
                Log::info('Processing dynamic_fields in updateCourseInfo...');
                foreach ($request->input('dynamic_fields') as $fieldId => $value) {
                    $field = AdditionalField::find($fieldId);

                    Log::info('Processing dynamic field', [
                        'user_id' => $user?->id,
                        'field_id' => $fieldId,
                        'value' => $value,
                        'field_section' => $field?->section
                    ]);

                    if (!$field) {
                        Log::warning("AdditionalField not found for field_id: $fieldId");
                        continue;
                    }

                    if ($field->section === 'course') {
                        if (empty($value) && $value !== '0') {              
                            Log::warning("Empty value for dynamic field in course section", ['field_id' => $fieldId, 'value' => $value]);
                            continue;
                        }
                        UserAdditionalFieldValue::updateOrCreate(
                            ['user_id' => $user->id, 'field_id' => $fieldId],
                            ['value' => is_array($value) ? json_encode($value) : $value]
                        );
                        Log::info("Dynamic field updated for course", [
                            'user_id' => $user->id,
                            'field_id' => $fieldId,
                            'value' => $value
                        ]);
                    } else {
                        Log::info("Field section mismatch, skipping dynamic field", [
                            'field_id' => $fieldId,
                            'expected_section' => 'course',
                            'actual_section' => $field->section
                        ]);
                    }
                }
            } else {
                Log::info('No dynamic_fields present in updateCourseInfo request.');
            }

            $courseInfoDetail->save();

            return response()->json(['success' => true, 'message' => 'Your details have been updated successfully.']);
        } catch (\Exception $e) {
            Log::error('Error updating course info: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'An error occurred while updating your details.']);
        }
    }


    public function updateAcademicsInfo(Request $request)
    {
        try {
            Log::info($request->all());

            $academicsDetailsInfo = Academics::find($request->personalInfoId);
            $user = User::where('unique_id', $request->personalInfoId)->first();


            if (!$academicsDetailsInfo || !$user) {
                return response()->json(['success' => false, 'message' => 'User not found.']);
            }

            $academicsDetailsInfo->gap_in_academics = $request->input('selectedAcademicGap');
            $academicsDetailsInfo->reason_for_gap = $request->input('reasonForGap');
            $academicsDetailsInfo->work_experience = $request->input('selectedWorkOption');

            $academicsDetailsInfo->ILETS = $request->input('ieltsScore');
            $academicsDetailsInfo->GRE = $request->input('greScore');
            $academicsDetailsInfo->TOFEL = $request->input('toeflScore');
            $academicsDetailsInfo->Others = json_encode($request->input('others'));
            $academicsDetailsInfo->university_school_name = $request->input("universityName");
            $academicsDetailsInfo->course_name = $request->input("courseName");
            if ($request->has('dynamic_fields')) {
                foreach ($request->input('dynamic_fields') as $fieldId => $value) {
                    $field = AdditionalField::find($fieldId);
                    Log::info($field);

                    if ($field && $field->section === 'academic') {
                        UserAdditionalFieldValue::updateOrCreate(
                            ['user_id' => $user->id, 'field_id' => $fieldId],
                            ['value' => is_array($value) ? json_encode($value) : $value]
                        );
                    }

                }
            }


            $academicsDetailsInfo->save();

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
            $coBorrowerInfo->co_borrower_relation = $request->input('co_borrower_relation');

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

    public function getEducationDetails(Request $request)
    {
        // Get user_id from query parameter
        $userId = $request->query('user_id');

        // Fetch data from Academics model
        $academics = $userId ? Academics::where('user_id', $userId)->first() : null;

        // Fetch data from CourseInfo model
        $courseInfo = $userId ? CourseInfo::where('user_id', $userId)->first() : null;

        // Prepare the response with the required fields
        $educationData = [
            'university_school_name' => $academics ? $academics->university_school_name : null,
            'course_name' => $academics ? $academics->course_name : null,
            'degree_type' => $courseInfo ? $courseInfo->{'degree-type'} : null,
        ];

        return response()->json([
            'success' => true,
            'data' => $educationData,
        ], 200);
    }


    public function getDynamicDocuments(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer'
        ]);

        $user_id = $request->user_id;

        $documentTypes = DocumentType::all();

        // Get user documents keyed by document_type_id for quick lookup
        $userDocuments = UserDocument::where('user_id', $user_id)->get()->keyBy('document_type_id');

        return response()->json([
            'documentTypes' => $documentTypes,
            'userDocuments' => $userDocuments,
        ]);
    }

}