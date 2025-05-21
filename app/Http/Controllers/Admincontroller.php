<?php

namespace App\Http\Controllers;

use App\Mail\PromotionalContentMail;
use App\Models\Academics;
use App\Models\AdditionalField;
use App\Models\Admin;
use App\Models\CourseDuration;
use App\Models\CourseInfo;
use App\Models\Degree;
use App\Models\DocumentType;
use App\Models\landingpage;
use App\Models\Nbfc;
use App\Models\PersonalInfo;
use App\Models\PlanToCountry;
use App\Models\proposalcompletion;
use App\Models\Proposals;
use App\Models\Rejectedbynbfc;
use App\Models\Requestedbyusers;
use App\Models\Requestprogress;
use App\Models\Scuser;
use App\Models\SocialOption;
use App\Models\StudentApplicationForm;
use App\Models\StudentApplicationSection;
use App\Models\User;
use App\Models\UserAdditionalFieldValue;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard\Duration;

class Admincontroller extends Controller
{


    public function retrieveDashboardDetails()
    {
        try {
            // Count of students who have been issued offers
            $offerIssuedStudentsCount = Requestprogress::where('type', 'proposal')->count();

            // Count of students who rejected the offer
            $offerRejectedByStudentCount = proposalcompletion::where('proposal_accept', false)->count();

            // Count of students who accepted and closed the proposal
            $offerAcceptedAndClosedCount = proposalcompletion::where('proposal_accept', true)->count();

            // Total incomplete count (no breakdown)
            $incompleteCount = DB::table('course_details_formdata')
                ->count();

            return response()->json([
                'message' => true,
                'counts' => [
                    'offerIssuedStudentsCount' => $offerIssuedStudentsCount,
                    'offerRejectedByStudentCount' => $offerRejectedByStudentCount,
                    'offerAcceptedAndClosedCount' => $offerAcceptedAndClosedCount,
                    'incompleteCount' => $incompleteCount,
                ],
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => false,
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function pointOfEntries(Request $request)
    {
        try {
            // Define the expected categories based on the image
            $categories = [
                'youtube',
                'Google',
                'Friend',
                'Others'
            ];

            // Initialize an array to store counts for each category
            $counts = [];

            // Fetch counts for each category from the PersonalInfo model
            foreach ($categories as $category) {
                $count = PersonalInfo::where('linked_through', $category)->count();
                $counts[] = $count;
            }

            return response()->json([
                "message" => true,
                "counts" => $counts,
                "categories" => $categories
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "message" => false,
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function nbfcLeadGens(Request $request)
    {
        try {
            // Fetch all NBFCs from the nbfc table
            $nbfcRecords = Nbfc::all();

            // Extract NBFC names and IDs
            $nbfcs = $nbfcRecords->pluck('nbfc_name')->toArray();
            $nbfcIds = $nbfcRecords->pluck('nbfc_id', 'nbfc_name')->toArray();

            $leadCounts = [];
            $timeTaken = [];

            foreach ($nbfcs as $nbfcName) {
                // Get the NBFC ID for the current NBFC name
                $nbfcId = $nbfcIds[$nbfcName] ?? null;

                if (!$nbfcId) {
                    $leadCounts[] = 0;
                    $timeTaken[] = 0;
                    continue;
                }


                $leadCount = Requestprogress::where('nbfc_id', $nbfcId)
                    ->count();
                $leadCounts[] = $leadCount;

                // Step 2: Calculate the average time taken for accepted proposals in days
                $acceptedProposals = proposalcompletion::where('nbfc_id', $nbfcId)
                    ->where('proposal_accept', true)
                    ->get();

                $totalTimeInDays = 0;
                $acceptedCount = $acceptedProposals->count();

                // Log the number of accepted proposals for debugging
                Log::info("NBFC: {$nbfcName}, NBFC ID: {$nbfcId}, Accepted Proposals Count: {$acceptedCount}");

                if ($acceptedCount > 0) {
                    foreach ($acceptedProposals as $proposal) {
                        $userId = $proposal->user_id;


                        $requestEntry = Requestprogress::where('user_id', $userId)
                            ->where('nbfc_id', $nbfcId)
                            ->first();

                        if ($requestEntry) {
                            // Calculate the time difference in days
                            $requestTime = $requestEntry->created_at;
                            $proposalTime = $proposal->created_at;

                            // Ensure timestamps are valid
                            if ($requestTime && $proposalTime) {
                                $daysDifference = $proposalTime->diffInDays($requestTime);
                                $totalTimeInDays += $daysDifference;

                                // Log the time difference for each user
                                Log::info("NBFC: {$nbfcName}, User: {$userId}, Days Difference: {$daysDifference}, Request Time: {$requestTime},Proposal Time: {$proposalTime}");
                            } else {
                                Log::warning("NBFC: {$nbfcName}, User: {$userId}, Invalid timestamps - Request: {$requestTime}, Proposal:{$proposalTime}");
                            }
                        } else {
                            Log::warning("NBFC: {$nbfcName}, User: {$userId}, No matching request entry found in traceprogress");
                        }
                    }

                    // Calculate the average time in days
                    $averageTimeInDays = $acceptedCount > 0 ? round($totalTimeInDays / $acceptedCount, 2) : 0;

                    // Log the average time
                    Log::info("NBFC: {$nbfcName}, Total Time (Days): {$totalTimeInDays}, Average Time (Days): {$averageTimeInDays}");
                } else {
                    $averageTimeInDays = 0;
                    Log::info("NBFC: {$nbfcName}, No accepted proposals found, setting average time to 0");
                }

                $timeTaken[] = $averageTimeInDays;
            }

            return response()->json([
                "message" => true,
                "nbfcs" => $nbfcs,
                "lead_counts" => $leadCounts,
                "time_taken" => $timeTaken
            ], 200);
        } catch (Exception $e) {
            Log::error("Error in nbfcLeadGens: {$e->getMessage()}");
            return response()->json([
                "message" => false,
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function scLeadGens(Request $request)
    {
        try {
            // Fetch distinct referral codes from the users table (excluding null/empty values)
            $referralCodes = User::whereNotNull('referral_code')
                ->where('referral_code', '!=', '')
                ->distinct()
                ->pluck('referral_code')
                ->toArray();

            $leadCounts = [];

            // Count the number of users (leads) for each referral code
            foreach ($referralCodes as $referralCode) {
                $leadCount = User::where('referral_code', $referralCode)->count();
                $leadCounts[] = $leadCount;
            }

            return response()->json([
                "message" => true,
                "student_counsellors" => $referralCodes,
                "lead_counts" => $leadCounts
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "message" => false,
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function reportsOnGeneration(Request $request)
    {
        try {
            $month = $request->input('month'); // optional
            $year = $request->input('year');   // optional

            // Define the days of the week (fixed order)
            $daysOfWeek = [
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday',
                'Sunday'
            ];

            // Base query
            $query = User::select(
                DB::raw("DAYNAME(created_at) as day_of_week"),
                DB::raw("COUNT(*) as registration_count")
            );

            // Apply month/year filter if present
            if ($month && $year) {
                $query->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year);
            }

            $registrationsByDay = $query
                ->groupBy(DB::raw("DAYNAME(created_at)"))
                ->pluck('registration_count', 'day_of_week')
                ->toArray();

            // Initialize default counts
            $registrationCounts = array_fill(0, 7, 0);

            // Map actual counts to correct index
            foreach ($registrationsByDay as $day => $count) {
                $dayIndex = array_search($day, $daysOfWeek);
                if ($dayIndex !== false) {
                    $registrationCounts[$dayIndex] = $count;
                }
            }

            return response()->json([
                "message" => true,
                "days_of_week" => $daysOfWeek,
                "registration_counts" => $registrationCounts
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                "message" => false,
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function getProfileCompletionByGenderAndDegree()
    {
        try {
            // Query with proper categorization
            $results = DB::table('course_details_formdata')
                ->join('users', 'course_details_formdata.user_id', '=', 'users.unique_id')
                ->join('personal_infos', 'users.unique_id', '=', 'personal_infos.user_id')
                ->select(
                    DB::raw("CASE
                        WHEN LOWER(course_details_formdata.`degree-type`) LIKE '%bachelor%' THEN 'UG'
                        WHEN LOWER(course_details_formdata.`degree-type`) LIKE '%master%' THEN 'PG'
                        WHEN LOWER(course_details_formdata.`degree-type`) LIKE '%mca%' OR LOWER(course_details_formdata.`degree-type`) LIKE
                        '%bca%' THEN 'Other'
                        ELSE 'Other'
                        END as degree_category"),
                    'personal_infos.gender',
                    DB::raw('count(*) as count')
                )
                ->groupBy('degree_category', 'personal_infos.gender')
                ->get();

            // Initialize breakdown summary
            $summary = [
                'UG' => ['total' => 0, 'male' => 0, 'female' => 0, 'other' => 0],
                'PG' => ['total' => 0, 'male' => 0, 'female' => 0, 'other' => 0],
                'Other' => ['total' => 0, 'male' => 0, 'female' => 0, 'other' => 0],
            ];

            // Initialize overall total
            $overall = ['total' => 0, 'male' => 0, 'female' => 0, 'other' => 0];

            // Fill data
            foreach ($results as $row) {
                $degree = $row->degree_category;
                $gender = strtolower($row->gender ?? 'other');

                if (!in_array($gender, ['male', 'female'])) {
                    $gender = 'other';
                }

                $summary[$degree][$gender] += $row->count;
                $summary[$degree]['total'] += $row->count;

                $overall[$gender] += $row->count;
                $overall['total'] += $row->count;
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'degree_summary' => $summary,
                    'overall' => $overall,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching gender-wise data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function validateprofilecompletion(Request $request)
    {
        $targetDegree = strtolower(trim($request->input('degree_type')));

        // Define tables and columns to check for profile completion
        $tablesAndColumns = [
            'users' => ['email', 'phone'],
            'personal_infos' => ['full_name', 'referral_code', 'state', 'linked_through'],
            'academic_details' => ['gap_in_academics', 'work_experience', 'university_school_name', 'course_name'],
            'coborrower_details' => [
                'co_borrower_relation',
                'co_borrower_income',
                'co_borrower_monthly_liability',
                'liability_select'
            ],
            'course_details_formdata' => [
                'plan-to-study',
                'degree-type',
                'course-duration',
                'course-details',
                'loan_amount_in_lakhs'
            ],
        ];

        // Get all users
        $users = DB::table('users')->select('unique_id')->get();

        $matchedUsers = [];
        $completedUsers = [];
        $incompleteUsers = [];

        foreach ($users as $user) {
            $userId = $user->unique_id;

            // Get course data to check if the user matches the target degree
            $courseData = DB::table('course_details_formdata')->where('user_id', $userId)->first();
            $degreeType = $courseData?->{'degree-type'} ?? null;

            if (!$degreeType || strtolower(trim($degreeType)) !== $targetDegree) {
                continue; // Skip users who don't match the target degree
            }

            $matchedUsers[] = $userId;

            $totalColumns = 0;
            $filledColumns = 0;

            // Check the completion status for each table/column combination
            foreach ($tablesAndColumns as $table => $columns) {
                if (!Schema::hasTable($table))
                    continue;

                $data = ($table === 'users')
                    ? DB::table($table)->where('unique_id', $userId)->first()
                    : DB::table($table)->where('user_id', $userId)->first();

                foreach ($columns as $column) {
                    $totalColumns++;
                    if (Schema::hasColumn($table, $column)) {
                        $value = $data->$column ?? null;
                        if (!is_null($value) && trim((string) $value) !== '') {
                            $filledColumns++;
                        }
                    }
                }
            }

            // Check the document count from the S3 storage (assuming 22 documents means full completion)
            $folderPath = "$userId"; // Assuming folder path based on userId
            $files = Storage::disk("s3")->allFiles($folderPath);
            $documentCount = count($files);

            // The user is considered completed if they have both 100% profile and exactly 22 documents
            $isProfileCompleted = ($totalColumns > 0 && $filledColumns === $totalColumns);
            $isDocumentCompleted = ($documentCount === 22);

            if ($isProfileCompleted && $isDocumentCompleted) {
                $completedUsers[] = $userId; // Add to completed users if both profile and documents are complete
            } else {
                $incompleteUsers[] = $userId; // Add to incomplete users otherwise
            }
        }

        return response()->json([
            'filtered_degree_type' => $targetDegree,
            'total_matching_users' => count($matchedUsers),
            'completed_profiles' => count($completedUsers),
            'incomplete_profiles' => count($incompleteUsers),
            'completed_user_ids' => $completedUsers,
            'incomplete_user_ids' => $incompleteUsers,
        ]);
    }

    public function showSCProfileJSON($referral)
    {
        $sc = Scuser::where('referral_code', $referral)->first();

        if (!$sc) {
            return response()->json(['error' => 'Counsellor not found'], 404);
        }

        return response()->json([
            'name' => $sc->name,
            'referral_code' => $sc->referral_code,
            'dob' => $sc->dob,
            'email' => $sc->email,
            'phone' => $sc->phone,
            'state' => $sc->state,
            'image' => asset('assets/images/image-women.jpeg') // or $sc->image_path
        ]);
    }


    public function getCityStats()
    {
        $data = PersonalInfo::select(
            'city',
            'state',
            DB::raw("SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) as female"),
            DB::raw("SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) as male"),
            DB::raw("COUNT(*) as total")
        )
            ->groupBy('city', 'state')
            ->get();

        return response()->json($data);
    }


    public function getDestinationCountries()
    {
        try {
            // Fetch the data with plan-to-study (JSON array) and gender
            $data = CourseInfo::select('course_details_formdata.plan-to-study', 'personal_infos.gender')
                ->join('personal_infos', 'course_details_formdata.user_id', '=', 'personal_infos.user_id')
                ->get();

            // Initialize an array to store the aggregated results
            $countryStats = [];

            // Process each record
            foreach ($data as $record) {
                // Decode the plan-to-study JSON array
                $countries = json_decode($record->{'plan-to-study'}, true);

                // If decoding fails or it's not an array, skip this record
                if (!is_array($countries)) {
                    continue;
                }

                // Get the gender for this record
                $gender = strtolower($record->gender); // Normalize to lowercase

                // Increment counts for each country in the array
                foreach ($countries as $country) {
                    // Normalize country name (trim, remove extra spaces)
                    $country = trim($country);

                    // Skip empty country names
                    if (empty($country)) {
                        continue;
                    }

                    // Initialize the country in the stats array if not present
                    if (!isset($countryStats[$country])) {
                        $countryStats[$country] = [
                            'female' => 0,
                            'male' => 0,
                            'total_students' => 0
                        ];
                    }

                    // Increment counts based on gender
                    if ($gender === 'female') {
                        $countryStats[$country]['female']++;
                    } elseif ($gender === 'male') {
                        $countryStats[$country]['male']++;
                    }

                    // Increment total students (regardless of gender)
                    $countryStats[$country]['total_students']++;
                }
            }

            // Convert the stats array to the desired response format
            $result = array_map(function ($country, $stats) {
                return [
                    'country' => $country,
                    'female' => $stats['female'],
                    'male' => $stats['male'],
                    'total_students' => $stats['total_students']
                ];
            }, array_keys($countryStats), $countryStats);

            // Sort by total_students (descending) for better presentation
            usort($result, function ($a, $b) {
                return $b['total_students'] - $a['total_students'];
            });

            return response()->json([
                'success' => true,
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch destination countries: ' . $e->getMessage()
            ], 500);
        }
    }



    public function mergeAllStudentDetails()
    {
        try {
            $users = User::all();
            $mergedDetails = [];

            foreach ($users as $user) {
                $personalInfo = PersonalInfo::where('user_id', $user->unique_id)->first();
                $courseInfo = CourseInfo::where('user_id', $user->unique_id)->get();

                // Fetch student counsellor name if referral_code exists
                $studentCounsellorName = null;
                $sourceReferral = null;
                if ($user->referral_code) {
                    $scuser = Scuser::where('referral_code', $user->referral_code)->first();
                    if ($scuser) {
                        $studentCounsellorName = $scuser->full_name;
                        $sourceReferral = "SC Referral";
                    }
                }

                // Retrieve the count of proposals for the current user
                $proposalCount = Requestprogress::where('user_id', $user->unique_id)
                    ->where('type', Requestprogress::TYPE_PROPOSAL)
                    ->count();

                $userDetails = [
                    'unique_id' => $user->unique_id,
                    'email' => $personalInfo ? $personalInfo->email : null,
                    'full_name' => $personalInfo ? $personalInfo->full_name : null,
                    'gender' => $personalInfo ? $personalInfo->gender : null,
                    'dateofbirth' => $personalInfo ? $personalInfo->dob : null,
                    'sourceOfReferral' => $sourceReferral ?? null,
                    'scReferral' => $user->referral_code ?? null,
                    'student_counsellor_name' => $studentCounsellorName ?? null,
                    'city' => $personalInfo->city ?? null,
                    'state' => $personalInfo->state ?? null,
                    'PointOfEntry' => $personalInfo->linked_through ?? null,
                    'phone_number' => $user->phone ?? null,
                    'degree_type' => null,
                    'loan_amount' => null,
                    'course_info' => [],
                    'proposal_count' => $proposalCount, // Add proposal count here
                ];

                // Check and add course details
                if ($courseInfo) {
                    foreach ($courseInfo as $course) {
                        $userDetails['course_info'][] = [
                            'plan_to_study' => json_decode($course->plan_to_study, true),
                            'degree_type' => $course->{'degree-type'}, // Access using the exact column name
                            'loan_amount_in_lakhs' => $course->loan_amount_in_lakhs
                        ];

                        // If degree_type and loan_amount are in courseInfo, add them
                        $userDetails['degree_type'] = $course->{'degree-type'};
                        $userDetails['loan_amount'] = $course->loan_amount_in_lakhs;
                    }
                }

                $mergedDetails[] = $userDetails;
            }

            return response()->json([
                'status' => 'success',
                'message' => 'All user details retrieved successfully.',
                'data' => $mergedDetails
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while retrieving user details.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function landingPage()
    {
        $landingpages = landingpage::get();
        return response()->json($landingpages);
    }

    public function store(Request $request)
    {
        try {
            // Log the incoming request data for debugging
            Log::debug('Incoming request data:', $request->all());

            // Validate the request
            $validated = $request->validate([
                'section_name' => 'required|string|max:255',
                'data' => 'required|array',
                'data.questions' => 'array',
                'data.questions.*.title' => 'required|string',
                'data.questions.*.fields' => 'array',
                'data.questions.*.fields.*.name' => 'required|string',
                'data.questions.*.fields.*.type' => 'required|in:text,dropdown,checkbox',
                'data.questions.*.fields.*.options' => 'array'
            ]);

            $sectionName = $validated['section_name'];
            $data = $validated['data'];
            $sectionSlug = Str::slug($sectionName);

            // Upsert the section with its data
            $form = StudentApplicationForm::updateOrCreate(
                ['section_slug' => $sectionSlug],
                [
                    'section_name' => $sectionName,
                    'section_slug' => $sectionSlug,
                    'data' => $data
                ]
            );

            Log::debug('Section saved:', ['id' => $form->id, 'section_slug' => $sectionSlug]);

            return response()->json(['success' => true, 'message' => 'Section and fields saved successfully', 'data' => $form->data]);
        } catch (Exception $e) {
            Log::error('Error saving section and fields:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['success' => false, 'message' => 'Failed to save section and fields', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($section_slug)
    {
        try {
            // Log the incoming request
            Log::debug('Retrieving section:', ['section_slug' => $section_slug]);

            $form = StudentApplicationForm::where('section_slug', $section_slug)->firstOrFail();

            Log::debug('Section retrieved:', ['id' => $form->id, 'section_name' => $form->section_name]);

            return response()->json(['success' => true, 'section_name' => $form->section_name, 'data' => $form->data]);
        } catch (Exception $e) {
            Log::error('Error retrieving section:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['success' => false, 'message' => 'Section not found', 'error' => $e->getMessage()], 404);
        }
    }



    public function promotionalEmail(Request $request)
    {
        Log::info('Promotional email request received', $request->all());
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
            'recipients' => 'required',
            'attachments.*' => 'nullable|file|mimes:pdf,doc,docx|max:10240'
        ]);
        if ($validator->fails()) {
            Log::error('Validation failed', $validator->errors()->toArray());
            return response()->json(['error' => 'Validation failed', 'details' => $validator->errors()], 422);
        }
        $recipients = json_decode($request->input('recipients'), true);
        if (!is_array($recipients) || empty($recipients)) {
            Log::error('Invalid or empty recipients array');
            return response()->json(['error' => 'Invalid or empty recipients array'], 422);
        }
        $validator = Validator::make($recipients, [
            '*.name' => 'nullable|string',
            '*.email' => 'required|email'
        ]);
        if ($validator->fails()) {
            Log::error('Recipient validation failed', $validator->errors()->toArray());
            return response()->json(['error' => 'Recipient validation failed', 'details' => $validator->errors()], 422);
        }
        $content = $request->input('content');
        $attachmentPaths = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('email_attachments', 'public');
                    $attachmentPaths[] = Storage::disk('public')->path($path);
                }
            }
        }
        $sentCount = 0;
        $errors = [];
        foreach ($recipients as $index => $recipient) {
            try {
                Log::info('Attempting to send email', ['email' => $recipient['email'], 'recipient_index' => $index]);
                $email = filter_var($recipient['email'], FILTER_SANITIZE_EMAIL);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new \Exception('Invalid email format');
                }
                $mail = Mail::to($email);
                $mailable = (new PromotionalContentMail($content));
                foreach ($attachmentPaths as $attachmentPath) {
                    $mailable->attach($attachmentPath);
                }
                $mail->send($mailable);
                Log::info('Email sent successfully', ['email' => $recipient['email']]);
                $sentCount++;
            } catch (\Exception $e) {
                Log::error('Failed to send email', ['email' => $recipient['email'], 'error' => $e->getMessage()]);
                $errors[] = 'Failed to send to ' . $recipient['email'] . ': ' . $e->getMessage();
            }
        }
        foreach ($attachmentPaths as $path) {
            if (file_exists($path)) {
                unlink($path);
            }
        }
        if ($sentCount === 0) {
            Log::error('No emails were sent', ['errors' => $errors]);
            return response()->json(['error' => 'No emails were sent', 'details' => $errors], 500);
        }
        $response = ['success' => true];
        if (!empty($errors)) {
            $response['partial_errors'] = $errors;
            $response['message'] = "Emails sent to $sentCount/" . count($recipients) . " recipients";
        } else {
            $response['message'] = "Emails sent successfully to $sentCount recipient" . ($sentCount > 1 ? 's' : '');
        }
        Log::info('Promotional email sending completed', $response);
        return response()->json($response);
    }


    public function attachImagePromotional(Request $request)
    {
        try {
            // Validate incoming request data
            $request->validate([
                'image' => 'required|image|max:2048',  // Validate image file
            ]);

            $image = $request->file('image');  // Get the uploaded image

            // Generate the file path in the S3 bucket
            $filePath = "admin/promotional-images/{$image->getClientOriginalName()}";

            // If the file already exists, delete it
            if (Storage::disk('s3')->exists($filePath)) {
                Storage::disk('s3')->delete($filePath);
            }

            // Upload the image to S3
            $path = Storage::disk('s3')->put($filePath, file_get_contents($image), 'public');

            // Get the URL of the uploaded file
            $fileUrl = Storage::disk('s3')->url($filePath);

            // Return a success response with the file URL
            return response()->json([
                'success' => true,
                'message' => 'Promotional image uploaded successfully.',
                'fileUrl' => $fileUrl,
            ], 200);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error uploading promotional image: ' . $e->getMessage());

            // Return an error response
            return response()->json(['error' => 'An error occurred while uploading the image.'], 500);
        }
    }



    public function initializeChatStudent()
    {
        try {
            $students = User::select('name', 'unique_id')->get();

            if ($students->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No students found.',
                ], 404); // HTTP status 404 - Not Found
            }

            // Return success response with students data
            return response()->json([
                'status' => 'success',
                'message' => 'Students retrieved successfully.',
                'data' => $students,
            ], 200); // HTTP status 200 - OK

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while retrieving students.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function initializeChatNbfc()
    {
        try {
            // Fetch students with necessary details (id, name, unique_id)
            $nbfc = Nbfc::select('nbfc_name', 'nbfc_id')->get();

            // Check if data was retrieved successfully
            if ($nbfc->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No students found.',
                ], 404); // HTTP status 404 - Not Found
            }

            // Return success response with students data
            return response()->json([
                'status' => 'success',
                'message' => 'Students retrieved successfully.',
                'data' => $nbfc,
            ], 200);

        } catch (\Exception $e) {
            // Handle errors (e.g., database errors, unexpected issues)
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while retrieving students.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function ageratioCalculation(Request $request)
    {
        try {
            $degreeType = $request->input('degree_type');

            $query = PersonalInfo::query();

            if (!empty($degreeType)) {
                $query->whereHas('courseInfo', function ($q) use ($degreeType) {
                    $q->where('degree-type', $degreeType);
                });
            }

            $personalInfos = $query->get();

            $ageGroups = [
                '16-20' => 0,
                '21-25' => 0,
                '26-30' => 0,
                '31-40' => 0,
            ];

            foreach ($personalInfos as $info) {
                if (empty($info->dob))
                    continue;

                try {
                    $dob = Carbon::createFromFormat('d/m/Y', $info->dob);
                    $age = $dob->age;

                    if ($age >= 16 && $age <= 20) {
                        $ageGroups['16-20']++;
                    } elseif ($age >= 21 && $age <= 25) {
                        $ageGroups['21-25']++;
                    } elseif ($age >= 26 && $age <= 30) {
                        $ageGroups['26-30']++;
                    } elseif ($age >= 31 && $age <= 40) {
                        $ageGroups['31-40']++;
                    }
                } catch (\Exception $e) {
                    continue;
                }
            }

            return response()->json([
                'success' => true,
                'age_ratio' => $ageGroups,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function sourceRegistration()
    {
        $scReferralCount = 0;
        $addsCount = 0;
        $organicCount = 0;

        $totalUsers = PersonalInfo::count();

        $personalInfos = PersonalInfo::with('user')->get();

        foreach ($personalInfos as $info) {

            $hasSCReferral = false;

            if (!empty($info->referral_code)) {
                $referrer = User::where('referral_code', $info->referral_code)->first();

                if ($referrer) {
                    $linkedThrough = strtolower($referrer->linked_through);

                    if ($linkedThrough == 'google' || $linkedThrough == 'youtube') {
                        $addsCount++;
                    } else {
                        $scReferralCount++;
                    }

                    $hasSCReferral = true;
                }
            }

            // If no SC Referral found, check linked_through of current user
            if (!$hasSCReferral) {
                $linkedThrough = strtolower($info->linked_through);

                if ($linkedThrough == 'google' || $linkedThrough == 'youtube') {
                    $addsCount++;
                } else {
                    $organicCount++;
                }
            }
        }

        // Calculate percentages
        $scReferralPercentage = $totalUsers > 0 ? round(($scReferralCount / $totalUsers) * 100, 2) : 0;
        $addsPercentage = $totalUsers > 0 ? round(($addsCount / $totalUsers) * 100, 2) : 0;
        $organicPercentage = $totalUsers > 0 ? round(($organicCount / $totalUsers) * 100, 2) : 0;

        // Return the data as JSON
        return response()->json([
            'SC Referral' => [
                'count' => $scReferralCount,
                'percentage' => $scReferralPercentage
            ],
            'ADDS' => [
                'count' => $addsCount,
                'percentage' => $addsPercentage
            ],
            'Organic' => [
                'count' => $organicCount,
                'percentage' => $organicPercentage
            ],
            'Total Users' => $totalUsers
        ]);
    }



    public function fetchRecipients()
    {
        $userAccess = User::all();

        if ($userAccess->isNotEmpty()) {
            return response()->json([
                'success' => true,
                'message' => "Recipients retrieved successfully",
                'data' => $userAccess
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "No recipients found",
                'data' => []
            ], 404);
        }
    }

    public function getAdmins(Request $request)
    {
        try {
            $admins = Admin::select('admin_id', 'name', 'email', 'is_super_admin', 'created_at')
                ->get();
            if ($admins->isEmpty()) {
                return response()->json(['message' => 'No admins found'], 404);
            }
            return response()->json([
                'success' => true,
                'data' => $admins
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching admins: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to fetch admins',
                'details' => $e->getMessage()
            ], 500);
        }
    }
    public function createAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'is_super_admin' => 'boolean'
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed for creating admin', $validator->errors()->toArray());
            return response()->json([
                'error' => 'Validation failed',
                'details' => $validator->errors()
            ], 422);
        }

        $email = $request->input('email');

        // Check email existence across all models
        $emailExists =
            Admin::where('email', $email)->exists() ||
            User::where('email', $email)->exists() ||
            Nbfc::where('nbfc_email', $email)->exists() ||
            Scuser::where('email', $email)->exists();

        if ($emailExists) {
            return response()->json([
                'error' => 'Email already exists in the system. Please use a different email.'
            ], 409); // 409 Conflict
        }

        try {
            $generatedPassword = Str::random(12); // Secure random password

            $admin = Admin::create([
                'name' => $request->input('name'),
                'email' => $email,
                'password' => Hash::make($generatedPassword),
                'is_super_admin' => $request->input('is_super_admin', false),
            ]);

            // Optionally email the password
            // Mail::to($admin->email)->send(new NewAdminPasswordMail($generatedPassword));

            return response()->json([
                'success' => true,
                'message' => 'Admin created successfully',
                'data' => [
                    'admin_id' => $admin->admin_id,
                    'name' => $admin->name,
                    'email' => $admin->email,
                    'is_super_admin' => $admin->is_super_admin,
                    'created_at' => $admin->created_at,
                ]
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating admin: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to create admin',
                'details' => $e->getMessage()
            ], 500);
        }



    }

    public function updateAdmin(Request $request, $id)
    {
        // Retrieve the admin using the custom admin_id field
        $admin = Admin::where('admin_id', $id)->first();
        if (!$admin) {
            Log::error("Admin not found: {$id}");
            return response()->json([
                'error' => 'Admin not found'
            ], 404);
        }

        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admin,email,' . $admin->id, // ignore current admin record
            'is_super_admin' => 'boolean'
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed for updating admin', $validator->errors()->toArray());
            return response()->json([
                'error' => 'Validation failed',
                'details' => $validator->errors()
            ], 422);
        }

        try {
            // Update the admin's fields
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->is_super_admin = $request->input('is_super_admin', false);
            $admin->save();

            return response()->json([
                'success' => true,
                'message' => 'Admin updated successfully',
                'data' => [
                    'admin_id' => $admin->admin_id,
                    'name' => $admin->name,
                    'email' => $admin->email,
                    'is_super_admin' => $admin->is_super_admin,
                    'updated_at' => $admin->updated_at
                ]
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error updating admin: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to update admin',
                'details' => $e->getMessage()
            ], 500);
        }
    }






    public function showStudentForm()
    {
        $user = session('user');

        if (!$user) {
            return redirect()->route('login')->withErrors('Please log in to access the form.');
        }

        $uniqueId = $user->unique_id;

        // Fetch data from social_options table
        $socialOptions = SocialOption::all();
        $countries = PlanToCountry::all();
        $degrees = Degree::all();
        $courseDuration = CourseDuration::all();
        $additionalFields = AdditionalField::all();
        $documentTypes = DocumentType::all();






        return view('pages.studentformquestionair', compact('user', 'socialOptions', 'countries', 'degrees', 'courseDuration', 'additionalFields', 'documentTypes'));
    }


    public function showStudentFormAdmin()
    {


        $socialOptions = SocialOption::all();

        return response()->json([
            'socialOptions' => $socialOptions
        ]);
    }
    public function showAdditionalPersonalInfoData()
    {


        $additionalFields = AdditionalField::all();


        return response()->json([
            'additionalFields' => $additionalFields
        ]);
    }
    // app/Http/Controllers/AdditionalFieldController.php

    public function addAdditionalPersonalInfoData(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:text,date,select,checkbox,radio,file',
            'required' => 'boolean',
            'options' => 'nullable|array',
        ]);

        $field = AdditionalField::create($validated);

        return response()->json(['field' => $field], 201);
    }

    public function showStudentPersonalInfoAdditionalField()
    {
        $documentTypes = DocumentType::all();

        return response()->json([
            'documentTypes' => $documentTypes
        ]);

    }
    public function showStudentPlanForCountriesAdmin()
    {


        $countries = PlanToCountry::all();

        return response()->json([
            'countries' => $countries
        ]);
    }
    public function showStudentCourseDuration()
    {


        $duration = CourseDuration::all();

        return response()->json([
            'duration' => $duration
        ]);
    }
    public function showStudentCourse()
    {


        $degree = Degree::all();

        return response()->json([
            'degree' => $degree
        ]);
    }

    public function deleteDegreesAdminside($id)
    {
        $degree = Degree::find($id);

        if (!$degree) {
            return response()->json(['message' => 'Social option not found.'], 404);
        }

        $degree->delete();

        return response()->json(['message' => 'Deleted successfully.'], 200);
    }
    public function deleteInfoForAdminSocial($id)
    {
        $socialOption = SocialOption::find($id);

        if (!$socialOption) {
            return response()->json(['message' => 'Social option not found.'], 404);
        }

        $socialOption->delete();

        return response()->json(['message' => 'Deleted successfully.'], 200);
    }
    public function deleteInfoForAdminPlanToStudy($id)
    {
        $plantocountry = PlanToCountry::find($id);

        if (!$plantocountry) {
            return response()->json(['message' => 'Social option not found.'], 404);
        }

        $plantocountry->delete();

        return response()->json(['message' => 'Deleted successfully.'], 200);
    }
    public function deleteCourseDuration($id)
    {
        $duration = CourseDuration::find($id);

        if (!$duration) {
            return response()->json(['message' => 'Social option not found.'], 404);
        }

        $duration->delete();

        return response()->json(['message' => 'Duration Deleted successfully.'], 200);
    }
    public function deleteDynamicKycField($id)
    {
        $document = DocumentType::find($id);

        if (!$document) {
            return response()->json(['message' => 'Document not found.'], 404);
        }

        $document->delete();

        return response()->json(['message' => 'Document deleted successfully.'], 200);
    }


    public function storeSocialOption(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
        ]);

        $socialOption = SocialOption::create($validated);

        return response()->json([
            'message' => 'Social option added successfully.',
            'data' => $socialOption
        ], 201);
    }
    public function storeCourseDuration(Request $request)
    {
        $validated = $request->validate([
            'duration_in_months' => 'required|string',
        ]);

        $courseduration = CourseDuration::create($validated);

        return response()->json([
            'message' => 'Course Duration added successfully.',
            'data' => $courseduration
        ], 201);
    }
    public function storePlanToStudyCountry(Request $request)
    {
        $validated = $request->validate([
            'country_name' => 'required|string',
        ]);

        $planToStudy = PlanToCountry::create($validated);

        return response()->json([
            'message' => 'Country added successfully.',
            'data' => $planToStudy
        ], 201);
    }
    public function storeDegreeAdmin(Request $request)
    {
        $validated = $request->validate([
            'degree_type' => 'required|string',
        ]);

        $degree = Degree::create($validated);

        return response()->json([
            'message' => 'Degree added successfully.',
            'data' => $degree
        ], 201);
    }


    public function getReferralAcceptedCounts()
    {
        $scReferrers = User::whereNotNull('referral_code')->get();
        $result = [];

        foreach ($scReferrers as $referrer) {
            $count = Requestprogress::where('type', Requestprogress::TYPE_PROPOSAL)
                ->whereIn('user_id', function ($query) use ($referrer) {
                    $query->select('unique_id')
                        ->from('users')
                        ->where('referral_code', $referrer->referral_code);
                })
                ->distinct('user_id')
                ->count('user_id');

            $result[$referrer->referral_code] = $count;
        }

        return response()->json($result);
    }




    public function uploadChatFile(Request $request)
    {
        // Validate the request to ensure a file and chatId are provided
        $request->validate([
            'file' => 'required|file|max:5120|mimes:pdf,doc,docx,txt',

            'chatId' => 'required|string'
        ]);

        // Get the chatId from the request
        $chatId = $request->input('chatId');

        // Check if the file is uploaded
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            // Generate a unique file name to avoid conflicts
            $fileName = time() . '_' . $file->getClientOriginalName();
            // Set the file directory path on S3
            $fileDirectory = "chats/{$chatId}/files";

            // Upload the file to the specified S3 directory
            $filePath = "$fileDirectory/$fileName";

            Storage::disk('s3')->put(
                $filePath,
                file_get_contents($file),
                [
                    'visibility' => 'public',
                    'ContentType' => $file->getMimeType(), // important!
                ]
            );


            // Get the URL of the uploaded file on S3
            $fileUrl = Storage::disk('s3')->url($filePath);

            // Return a success response with the file information
            return response()->json([
                'success' => true,
                'message' => 'File uploaded successfully!',
                'file_name' => $fileName,
                'fileUrl' => $fileUrl, // Send the URL to be used in the chat
            ], 200);
        }

        // If no file is uploaded, return an error response
        return response()->json([
            'success' => false,
            'message' => 'No file uploaded.',
        ], 400);
    }

    public function updateNbfc(Request $request)
    {
        try {
            // Validate the incoming request
            $validator = Validator::make($request->all(), [
                'id' => 'required|string',
                'nbfc_name' => 'required|string|max:255',
                'nbfc_type' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Retrieve the NBFC record using nbfc_id
            $nbfc = Nbfc::where('nbfc_id', $request->id)->first();

            if (!$nbfc) {
                return response()->json([
                    'success' => false,
                    'message' => 'NBFC not found.'
                ], 404);
            }

            // Update fields
            $nbfc->nbfc_name = $request->nbfc_name;
            $nbfc->nbfc_type = $request->nbfc_type;
            $nbfc->save();

            return response()->json([
                'success' => true,
                'message' => 'NBFC updated successfully.',
                'data' => $nbfc
            ], 200);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('NBFC update error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function suspendNbfc(Request $request)
    {
        try {
            // Validate the incoming request
            $validator = Validator::make($request->all(), [
                'nbfc_id' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Retrieve the NBFC record using custom string nbfc_id
            $nbfc = Nbfc::where('nbfc_id', $request->nbfc_id)->first();

            if (!$nbfc) {
                return response()->json([
                    'success' => false,
                    'message' => 'NBFC not found with the provided nbfc_id.'
                ], 404);
            }

            // Update status
            $nbfc->status = 'suspended';
            $nbfc->save();

            return response()->json([
                'success' => true,
                'message' => 'NBFC suspended successfully.',
                'data' => $nbfc
            ], 200);
        } catch (\Exception $e) {
            Log::error('NBFC Suspend error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function getUserProfileAdminSide(Request $request)
    {
        try {
            $uniqueId = $request->input('unique_id');

            // Step 1: Get the user using unique_id
            $user = User::where('unique_id', $uniqueId)->first();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found.'
                ], 404);
            }


            $personalInfo = PersonalInfo::where('user_id', $user->unique_id)->first();
            $courseInfo = CourseInfo::where('user_id', $user->unique_id)->first();
            $academicInfo = Academics::where('user_id', $user->unique_id)->first();

            // Initialize variables
            $state = '';
            $city = '';
            $planToStudy = '';
            $degreeType = '';
            $courseDuration = '';
            $loanAmount = '';

            $ilets = '';
            $gre = '';
            $tofel = '';
            $others = [];
            $universityName = '';
            $courseName = '';

            // Fill from personalInfo if exists
            if ($personalInfo) {
                $state = $personalInfo->state ?? '';
                $city = $personalInfo->city ?? '';
            }

            // Fill from courseInfo if exists
            if ($courseInfo) {
                $planToStudy = $courseInfo->{'plan-to-study'} ?? '';
                $degreeType = $courseInfo->{'degree-type'} ?? '';
                $courseDuration = $courseInfo->{'course-duration'} ?? '';
                $loanAmount = $courseInfo->loan_amount_in_lakhs ?? '';
            }

            // Fill from academicInfo if exists
            if ($academicInfo) {
                $ilets = $academicInfo->ILETS ?? '';
                $gre = $academicInfo->GRE ?? '';
                $tofel = $academicInfo->TOFEL ?? '';
                $universityName = $academicInfo->university_school_name ?? '';
                $courseName = $academicInfo->course_name ?? '';

                if (!empty($academicInfo->Others)) {
                    $decodedOthers = json_decode($academicInfo->Others, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $others = $decodedOthers;
                    }
                }
            }

            // Final response
            $data = [
                'user_id' => $user->unique_id,
                'name' => $user->name ?? '',
                'phone' => $user->phone ?? '',
                'email' => $user->email ?? '',
                'referral_code' => $user->referral_code ?? '',

                'state' => $state,
                'city' => $city,

                'plan_to_study' => $planToStudy,
                'degree_type' => $degreeType,
                'course_duration' => $courseDuration,
                'loan_amount' => $loanAmount,

                'university_school_name' => $universityName,
                'course_name' => $courseName,

                'test_scores' => [
                    'ILETS' => $ilets,
                    'TOFEL' => $tofel,
                    'GRE' => $gre,
                    'Others' => $others
                ]
            ];

            return response()->json([
                'status' => true,
                'message' => 'User profile fetched successfully.',
                'data' => $data
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while fetching the profile.',
                'error' => $e->getMessage()
            ], 500);
        }
    }




    public function storeKYCDynamic(Request $request)
    {
        $request->validate(rules: [
            'name' => 'required|string|max:255'
        ]);

        $name = strtolower(trim($request->input('name')));

        Log::info($name);
        $existing = DocumentType::whereRaw('LOWER(name) = ?', [$name])->first();
        Log::info($existing);

        if ($existing) {
            return response()->json(['message' => 'Document type already exists.'], 409);
        }

        $documentType = DocumentType::create([
            'name' => $request->input('name'), // Store original casing
            'key' => \Str::slug($request->input('name')) // optional
        ]);

        return response()->json($documentType, 201);
    }

    public function updatepersonalinfoadminside(Request $request)
    {
        try {
            $request->validate([
                'unique_id' => 'required|string',
                'name' => 'nullable|string',
                'email' => 'nullable|email',
                'state' => 'nullable|string',
                'phone' => 'nullable|string',
                'university_school_name' => 'nullable|string',
                'course_name' => 'nullable|string',
                'ILETS' => 'nullable|string',
                'GRE' => 'nullable|string',
                'TOFEL' => 'nullable|string',
                'plan_to_study' => 'nullable|array',
                'degree_type' => 'nullable|string',
                'course_duration' => 'nullable|string',
                'loan_amount' => 'nullable|string',
                'referral_code' => 'nullable|string'
            ]);

            $user = User::where('unique_id', $request->unique_id)->first();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not found.'], 404);
            }

            // Update User
            $user->name = $request->name ?? $user->name;
            $user->email = $request->email ?? $user->email;
            $user->phone = $request->phone ?? $user->phone;
            $user->save();

            // Update Personal Info
            $personalInfo = PersonalInfo::updateOrCreate(
                ['user_id' => $user->unique_id],
                [
                    'full_name' => $request->name,
                    'email' => $request->email,
                    'state' => $request->state,
                ]
            );

            // Update Academic Info
            $academicDetails = Academics::updateOrCreate(
                ['user_id' => $user->unique_id],
                [
                    'university_school_name' => $request->university_school_name,
                    'course_name' => $request->course_name,
                    'ILETS' => $request->ILETS,
                    'GRE' => $request->GRE,
                    'TOFEL' => $request->TOFEL,
                ]
            );

            // ✅ Update Course Info
            $courseInfo = CourseInfo::updateOrCreate(
                ['user_id' => $user->unique_id],
                [
                    'plan-to-study' => json_encode($request->plan_to_study),
                    'degree-type' => $request->degree_type,
                    'course-duration' => $request->course_duration,
                    'course-details' => $request->referral_code,
                    'loan_amount_in_lakhs' => $request->loan_amount
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'User details updated successfully.',
                'user' => $user,
                'personal_info' => $personalInfo,
                'academic_details' => $academicDetails,
                'course_info' => $courseInfo
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in updatepersonalinfoadminside:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating user info.',
                'error' => $e->getMessage()
            ], 500);
        }
    }






    public function deletePersonalInfoDynamicFields($id)
    {
        $field = AdditionalField::find($id);

        if (!$field) {
            return response()->json(['error' => 'Field not found.'], 404);
        }

        $field->delete();

        return response()->json(['success' => true]);
    }






    public function getUserDynamicFields($uniqueId)
    {
        $user = User::where('unique_id', $uniqueId)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $fieldValues = UserAdditionalFieldValue::with('field')
            ->where('user_id', $user->id)
            ->get();

        $formatted = $fieldValues->mapWithKeys(function ($item) {
            return [$item->field->label => $item->value];
        });

        return response()->json([
            'user' => $user->name,
            'fields' => $formatted
        ]);
    }

    public function getUserDynamicFieldsGroupedBySection($uniqueId)
    {
        // 1. Find the user by unique_id
        $user = User::where('unique_id', $uniqueId)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // 2. Get the additional field values with their related field definitions
        $fieldValues = UserAdditionalFieldValue::with('field')
            ->where('user_id', $user->id)
            ->get()
            ->groupBy(fn($item) => $item->field->section); // group by section

        // 3. Format the grouped data
        $formatted = $fieldValues->map(function ($items, $section) {
            return [
                'section' => $section,
                'fields' => $items->mapWithKeys(function ($item) {
                    return [$item->field->label => $item->value];
                }),
            ];
        })->values(); // to reset keys to numeric array

        // 4. Return the formatted response
        return response()->json([
            'user' => $user->name,
            'sections' => $formatted
        ]);
    }

}