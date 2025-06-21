<?php

namespace App\Http\Controllers;

use App\Mail\PromotionalContentMail;
use App\Mail\SendScDetailsMail;
use App\Models\Academics;
use App\Models\AdditionalField;
use App\Models\Admin;
use App\Models\CmsContent;
use App\Models\CoBorrowerInfo;
use App\Models\CourseDetailOption;
use App\Models\CourseDuration;
use App\Models\CourseInfo;
use App\Models\PartnerLogo;
use App\Models\Degree;
use App\Models\DocumentType;
use App\Models\Faq;
use App\Models\landingpage;
use App\Models\Nbfc;
use App\Models\PersonalInfo;
use App\Models\PlanToCountry;
use App\Models\proposalcompletion;
use App\Models\Proposals;
use App\Models\Queries;
use App\Models\Rejectedbynbfc;
use App\Models\Requestedbyusers;
use App\Models\Requestprogress;
use App\Models\Scuser;
use App\Models\SocialOption;
use App\Models\StudentApplicationForm;
use App\Models\StudentApplicationSection;
use App\Models\StudyLoanStep;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\UserAdditionalFieldValue;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
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
use Illuminate\Validation\Rule;


class Admincontroller extends Controller
{


    public function retrieveDashboardDetails(Request $request)
    {
        try {
            // Step 1: Get input degree type (optional), lowercase
            $inputDegree = strtolower($request->input('degree_type'));

            // Step 2: Define a closure to apply degree_type filtering on CourseInfo queries
            $degreeFilter = function ($query) use ($inputDegree) {
                if (in_array($inputDegree, ['bachelors', 'masters'])) {
                    $query->whereRaw('LOWER(`degree-type`) = ?', [$inputDegree]);
                } elseif ($inputDegree === 'others') {
                    $query->whereRaw('LOWER(`degree-type`) NOT IN (?, ?)', ['bachelors', 'masters']);
                }
                // If no inputDegree or unrecognized, no filter (all)
            };

            // Step 3: Get filtered user IDs from CourseInfo based on degree_type filter
            $filteredUserIds = CourseInfo::when($inputDegree, $degreeFilter)
                ->pluck('user_id')
                ->toArray();

            // Step 4: Counts with dynamic filtering using whereHas on CourseInfo relation

            // Offer issued students count in Requestprogress (type = proposal)
            $offerIssuedStudentsCount = Requestprogress::where('type', 'proposal')
                ->whereHas('courseInfo', $degreeFilter)
                ->count();

            // Offer rejected by student count in ProposalCompletion where proposal_accept = false
            $offerRejectedByStudentCount = proposalcompletion::where('proposal_accept', false)
                ->whereHas('courseInfo', $degreeFilter)
                ->count();

            // Offer accepted and closed count in ProposalCompletion where proposal_accept = true
            $offerAcceptedAndClosedCount = proposalcompletion::where('proposal_accept', true)
                ->whereHas('courseInfo', $degreeFilter)
                ->count();

            // Total user count from User model filtered by filteredUserIds from CourseInfo
            $totalUserCount = User::whereIn('id', $filteredUserIds)->count();

            // Step 5: Profile completion checks (user_id from filteredUserIds)

            // CoBorrower users
            $coBorrowerUsers = CoBorrowerInfo::whereIn('user_id', $filteredUserIds)
                ->pluck('user_id')
                ->toArray();

            // Academics users (where university_school_name and course_name are NOT NULL)
            $academicsUsers = Academics::whereIn('user_id', $filteredUserIds)
                ->whereNotNull('university_school_name')
                ->whereNotNull('course_name')
                ->pluck('user_id')
                ->toArray();

            // CourseInfo users (all filtered user IDs)
            $courseInfoUsers = $filteredUserIds;

            // Completed profiles = intersection of all three arrays
            $completedProfiles = array_intersect($coBorrowerUsers, $academicsUsers, $courseInfoUsers);

            // Incomplete profiles = filteredUserIds not in completedProfiles
            $incompleteProfiles = array_diff($courseInfoUsers, $completedProfiles);

            // Step 6: Return JSON response
            return response()->json([
                'success' => true,
                'counts' => [
                    'offerIssuedStudentsCount' => $offerIssuedStudentsCount,
                    'offerRejectedByStudentCount' => $offerRejectedByStudentCount,
                    'offerAcceptedAndClosedCount' => $offerAcceptedAndClosedCount,
                    'totalUserCount' => $totalUserCount,
                    'completedProfileCount' => count($completedProfiles),
                    'incompleteProfileCount' => count($incompleteProfiles),
                    'filteredDegreeType' => $inputDegree ?: 'all',
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving dashboard details',
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
            $converted = $request->input('converted', false);

            // Fetch all NBFCs from the nbfc table
            $nbfcRecords = Nbfc::all();
            $nbfcs = $nbfcRecords->pluck('nbfc_name')->toArray();
            $nbfcIds = $nbfcRecords->pluck('nbfc_id', 'nbfc_name')->toArray();

            $leadCounts = [];
            $timeTaken = [];
            foreach ($nbfcs as $nbfcName) {
                $nbfcId = $nbfcIds[$nbfcName] ?? null;

                if (!$nbfcId) {
                    $leadCounts[] = 0;
                    $timeTaken[] = 0;
                    continue;
                }

                if ($converted) {

                    $acceptedProposals = Proposalcompletion::where('nbfc_id', $nbfcId)
                        ->distinct('user_id')
                        ->get();


                    $acceptedUserIds = $acceptedProposals->pluck('user_id')->unique();
                    $leadCount = $acceptedUserIds->count();
                    $leadCounts[] = $leadCount;

                    $totalTimeInDays = 0;
                    $validProposals = 0;

                    foreach ($acceptedUserIds as $userId) {
                        $proposal = $acceptedProposals->where('user_id', $userId)->first(); // pick any one for average
                        $requestEntry = Requestprogress::where('user_id', $userId)
                            ->where('nbfc_id', $nbfcId)
                            ->first();

                        if ($proposal && $requestEntry) {
                            $daysDifference = $proposal->created_at->diffInDays($requestEntry->created_at);
                            $totalTimeInDays += $daysDifference;
                            $validProposals++;
                        }
                    }

                    $averageTimeInDays = $validProposals > 0 ? round($totalTimeInDays / $validProposals, 2) : 0;
                    $timeTaken[] = $averageTimeInDays;
                } else {
                    $leadCount = Requestprogress::where('nbfc_id', $nbfcId)->count();
                    $leadCounts[] = $leadCount;

                    $acceptedProposals = Proposalcompletion::where('nbfc_id', $nbfcId)->get();

                    $totalTimeInDays = 0;
                    $validProposals = 0;

                    foreach ($acceptedProposals as $proposal) {
                        $userId = $proposal->user_id;
                        $requestEntry = Requestprogress::where('user_id', $userId)
                            ->where('nbfc_id', $nbfcId)
                            ->first();

                        if ($requestEntry) {
                            $daysDifference = $proposal->created_at->diffInDays($requestEntry->created_at);
                            $totalTimeInDays += $daysDifference;
                            $validProposals++;
                        }
                    }

                    $averageTimeInDays = $validProposals > 0 ? round($totalTimeInDays / $validProposals, 2) : 0;
                    $timeTaken[] = $averageTimeInDays;
                }
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
            $converted = $request->input('converted', false);

            // Fetch distinct referral codes from users table
            $referralCodes = User::whereNotNull('referral_code')
                ->where('referral_code', '!=', '')
                ->distinct()
                ->pluck('referral_code')
                ->toArray();

            $leadCounts = [];

            foreach ($referralCodes as $referralCode) {
                if ($converted) {
                    // Count distinct users who have completed proposals and match the referral code
                    $leadCount = Proposalcompletion::whereHas('user', function ($query) use ($referralCode) {
                        $query->where('referral_code', $referralCode);
                    })->distinct('user_id')->count('user_id');
                } else {
                    // Count all users who used the referral code
                    $leadCount = User::where('referral_code', $referralCode)->count();
                }

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

    public function getProfileCompletionByGenderAndDegree(Request $request)
    {
        try {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');


            $query = DB::table('course_details_formdata')
                ->join('users', 'course_details_formdata.user_id', '=', 'users.unique_id')
                ->join('personal_infos', 'users.unique_id', '=', 'personal_infos.user_id');

            if ($startDate && $endDate) {
                $query->whereBetween('users.created_at', [$startDate, $endDate]);
            } elseif ($startDate) {
                $query->where('users.created_at', '>=', $startDate);
            } elseif ($endDate) {
                $query->where('users.created_at', '<=', $endDate);
            }

            $results = $query->select(
                DB::raw("CASE
                    WHEN LOWER(course_details_formdata.`degree-type`) LIKE '%bachelor%' THEN 'UG'
                    WHEN LOWER(course_details_formdata.`degree-type`) LIKE '%master%' THEN 'PG'
                    WHEN LOWER(course_details_formdata.`degree-type`) LIKE '%mca%' OR LOWER(course_details_formdata.`degree-type`) LIKE '%bca%' THEN 'Other'
                    ELSE 'Other'
                END as degree_category"),
                'personal_infos.gender',
                DB::raw('count(*) as count')
            )
                ->groupBy('degree_category', 'personal_infos.gender')
                ->get();

            $summary = [
                'UG' => ['total' => 0, 'male' => 0, 'female' => 0, 'other' => 0],
                'PG' => ['total' => 0, 'male' => 0, 'female' => 0, 'other' => 0],
                'Other' => ['total' => 0, 'male' => 0, 'female' => 0, 'other' => 0],
            ];

            $overall = ['total' => 0, 'male' => 0, 'female' => 0, 'other' => 0];

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

            $userQuery = DB::table('users');
            if ($startDate && $endDate) {
                $userQuery->whereBetween('created_at', [$startDate, $endDate]);
            } elseif ($startDate) {
                $userQuery->where('created_at', '>=', $startDate);
            } elseif ($endDate) {
                $userQuery->where('created_at', '<=', $endDate);
            }

            $totalUsers = $userQuery->count();

            $incompleteProfiles = $totalUsers - $overall['total'];
            if ($incompleteProfiles < 0)
                $incompleteProfiles = 0;

            return response()->json([
                'success' => true,
                'data' => [
                    'degree_summary' => $summary,
                    'overall' => $overall,
                    'total_users' => $totalUsers,
                    'incomplete_profiles' => $incompleteProfiles,
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









    public function mergeAllStudentDetails()
    {
        try {
            ini_set('memory_limit', '2048M');
            set_time_limit(600);

            $referralMap = Scuser::pluck('full_name', 'referral_code');

            $users = User::with([
                'personalInfo',
                'courseInfo',
                'requestProgress' => function ($query) {
                    $query->where('type', Requestprogress::TYPE_PROPOSAL);
                },
            ])->get();

            $mergedDetails = [];

            foreach ($users as $user) {
                $personalInfo = $user->personalInfo;
                $courseInfos = $user->courseInfo;

                $studentCounsellorName = $referralMap[$user->referral_code] ?? null;
                $sourceReferral = $studentCounsellorName ? 'SC Referral' : null;

                $userDetails = [
                    'unique_id' => $user->unique_id,
                    'email' => $user->email,
                    'full_name' => $user->name,
                    'gender' => $personalInfo->gender ?? null,
                    'dateofbirth' => $personalInfo->dob ?? null,
                    'sourceOfReferral' => $sourceReferral,
                    'scReferral' => $user->referral_code,
                    'student_counsellor_name' => $studentCounsellorName,
                    'city' => $personalInfo->city ?? null,
                    'state' => $personalInfo->state ?? null,
                    'PointOfEntry' => $personalInfo->linked_through ?? null,
                    'phone_number' => $user->phone,
                    'degree_type' => null,
                    'loan_amount' => null,
                    'course_info' => [],
                    'proposal_count' => $user->requestProgress->count(),
                    'registration_date' => $user->created_at?->format('d/m/Y'),
                ];

                if ($courseInfos->isNotEmpty()) {
                    foreach ($courseInfos as $course) {
                        $userDetails['course_info'][] = [
                            'plan_to_study' => json_decode($course->plan_to_study ?? '[]', true),
                            'degree_type' => $course->{'degree-type'},
                            'loan_amount_in_lakhs' => $course->loan_amount_in_lakhs
                        ];

                        // Set only first values for top-level degree/loan
                        if (!$userDetails['degree_type']) {
                            $userDetails['degree_type'] = $course->{'degree-type'};
                        }
                        if (!$userDetails['loan_amount']) {
                            $userDetails['loan_amount'] = $course->loan_amount_in_lakhs;
                        }
                    }
                }

                $mergedDetails[] = $userDetails;
            }

            return response()->json([
                'status' => 'success',
                'message' => 'All user details retrieved successfully.',
                'data' => $mergedDetails
            ]);
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
        $content = CmsContent::all(); // Get everything
        return response()->json($content);
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
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $email = $request->input('email');

        // Check email across other models
        $emailExists =
            Admin::where('email', $email)->exists() ||
            User::where('email', $email)->exists() ||
            Nbfc::where('nbfc_email', $email)->exists() ||
            Scuser::where('email', $email)->exists();

        if ($emailExists) {
            return response()->json([
                'success' => false,
                'message' => 'Email already exists in the system.'
            ], 409);
        }

        try {
            $generatedPassword = Str::random(12); // Secure random password

            $admin = Admin::create([
                'name' => $request->input('name'),
                'email' => $email,
                'password' => Hash::make($generatedPassword),
                'is_super_admin' => $request->input('is_super_admin', false),
            ]);

            // Send email
            Mail::to($admin->email)->send(new SendScDetailsMail($admin->email, $generatedPassword));

            return response()->json([
                'success' => true,
                'message' => 'Admin created successfully',
                'data' => [
                    'name' => $admin->name,
                    'email' => $admin->email,
                    'is_super_admin' => $admin->is_super_admin,
                    'created_at' => $admin->created_at,
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create admin',
                'error' => $e->getMessage()
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
            'email' => [
                'required',
                'email',
                Rule::unique((new Admin)->getTable(), 'email')->ignore($admin->admin_id, 'admin_id')
            ],
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
        $courseExpenseOptions = CourseDetailOption::all();







        return view('pages.studentformquestionair', compact('user', 'socialOptions', 'countries', 'degrees', 'courseDuration', 'additionalFields', 'documentTypes', 'courseExpenseOptions'));
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


        $additionalFields = AdditionalField::where('section', 'academic')->get();


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
            'type' => 'required|string|in:text,date,select,checkbox,radio',
            'required' => 'boolean',
            'options' => 'nullable|array',
            'sectionSeperate' => 'required|string'
        ]);

        // Remap the field to match the model column name
        $validated['section'] = $validated['sectionSeperate'];
        unset($validated['sectionSeperate']);

        $field = AdditionalField::create($validated);

        return response()->json(['field' => $field], 201);
    }


    public function showStudentPersonalInfoAdditionalField($slug)
    {
        $documentTypes = DocumentType::where('slug', $slug)->get();
        return response()->json(['documentTypes' => $documentTypes]);
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
        if (!$request->hasFile('file') || !$request->input('chatId')) {
            return response()->json([
                'success' => false,
                'message' => 'Missing file or chatId.',
            ], 400);
        }

        $file = $request->file('file');
        $chatId = $request->input('chatId');

        $fileName = time() . '_' . $file->getClientOriginalName();
        $fileDirectory = "chats/{$chatId}/files";
        $filePath = "$fileDirectory/$fileName";

        try {
            Storage::disk('s3')->put(
                $filePath,
                file_get_contents($file),
                [
                    'visibility' => 'public',
                    'ContentType' => $file->getMimeType(),
                ]
            );

            $fileUrl = Storage::disk('s3')->url($filePath);

            return response()->json([
                'success' => true,
                'fileUrl' => $fileUrl,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Upload failed.',
                'error' => $e->getMessage(),
            ], 500);
        }
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
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255'
        ]);

        $name = strtolower(trim($request->input('name')));
        $slug = strtolower(trim($request->input('slug')));

        Log::info("Checking for existing document with name: $name and slug: $slug");

        $existing = DocumentType::whereRaw('LOWER(name) = ?', [$name])
            ->where('slug', $slug)
            ->first();

        if ($existing) {
            return response()->json(['message' => 'Document type already exists for this section.'], 409);
        }

        $documentType = DocumentType::create([
            'name' => $request->input('name'), // Preserve original casing
            'key' => Str::slug($request->input('name')), // Optional
            'slug' => $slug
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
            $user->referral_code = $request->referral_code ?? $user->referral_code;
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
            Log::error('Error in updatepersonalinfoadminside:', [
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
            ->groupBy(fn ($item) => $item->field->section); // group by section

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



    public function getAcademicDynamicAdminSide()
    {
        $academicFields = AdditionalField::where('section', 'academic')->get();

        return response()->json([
            'success' => true,
            'data' => $academicFields,
        ]);
    }
    public function getCourseExpenseOptions()
    {
        $courseOptions = CourseDetailOption::all();

        return response()->json([
            'success' => true,
            'data' => $courseOptions,
        ]);
    }
    public function addCourseExpenseOptions(Request $request)
    {
        $request->validate([
            'label' => 'required|string',
        ]);

        $courseOption = CourseDetailOption::create([
            'label' => $request->input('label'),
        ]);

        return response()->json($courseOption, 201);
    }



    public function deleteAcademicField($id)
    {
        $field = AdditionalField::find($id);

        if (!$field) {
            return response()->json(['success' => false, 'message' => 'Field not found.'], 404);
        }

        $field->delete();

        return response()->json(['success' => true, 'message' => 'Field deleted successfully.']);
    }

    public function delCourseExpenseOptions($id)
    {
        $option = CourseDetailOption::find($id);
        if (!$option) {
            return response()->json(['message' => 'Option not found'], 404);
        }

        $option->delete();

        return response()->json(['message' => 'Option deleted successfully']);
    }

    public function updateTicketStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:queryraised,id',
        ]);

        $query = Queries::find($request->id);
        $query->status = 'deactive';
        $query->save();

        return response()->json([
            'success' => true,
            'message' => 'Ticket status updated successfully.'
        ]);
    }


    public function markQuery(Request $request)
    {
        $query = Queries::find($request->query_id);
        if ($query) {
            $query->status = $request->status;
            $query->is_reviewed = true;
            $query->save();

            if ($request->status === 'deactive') {
                $query->delete(); // optional
            }

            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Query not found']);
    }

    public function countDeactiveQueries(Request $request)
    {
        try {
            $request->validate([
                'scUserId' => 'required|string'
            ]);

            $scUserId = $request->input('scUserId');

            $count = Queries::where('scuserid', $scUserId)
                ->where('status', 'deactive')
                ->count();

            return response()->json([
                'success' => true,
                'count' => $count
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to count deactive queries',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function userProfileReport()
    {
        $users = User::all();

        $report = $users->map(function ($user) {
            $personalInfo = PersonalInfo::where('user_id', $user->unique_id)->first();
            $courseInfo = CourseInfo::where('user_id', $user->unique_id)->first();

            // Calculate age from dob
            $age = null;
            if ($personalInfo && $personalInfo->dob) {
                try {
                    $age = Carbon::parse($personalInfo->dob)->age;
                } catch (\Exception $e) {
                    $age = null;
                }
            }

            // Degree type logic
            $degreeTypeRaw = $courseInfo?->{'degree-type'};
            $degreeType = null;

            if ($degreeTypeRaw) {
                $degreeType = match (strtolower($degreeTypeRaw)) {
                    'masters' => 'Post Graduate',
                    'bachelors' => 'Under Graduate',
                    default => 'Others',
                };
            }

            // Plan to study: JSON string to clean comma list
            $planToStudy = null;
            if ($courseInfo && $courseInfo->{'plan-to-study'}) {
                $decoded = json_decode($courseInfo->{'plan-to-study'}, true);
                $planToStudy = is_array($decoded) ? implode(', ', $decoded) : $courseInfo->{'plan-to-study'};
            }

            return [
                'name' => $user->name,
                'unique_id' => $user->unique_id,
                'referral_code' => $user->referral_code,
                'gender' => $personalInfo?->gender,
                'age' => $age,
                'degree_type' => $degreeType,
                'plan_to_study' => $planToStudy,
            ];
        });

        return response()->json($report);
    }
    public function overallReportDownloadProgress()
    {
        $users = User::all();

        $report = $users->map(function ($user) {
            $personalInfo = PersonalInfo::where('user_id', $user->unique_id)->first();
            $linkedThrough = $personalInfo ? $personalInfo->linked_through : null;

            $type = null;

            if (!empty($user->referral_code)) {
                $type = 'SC Referral';
            } else {
                $adsTypes = ['instagram', 'social', 'youtube', 'facebook', 'twitter', 'google'];
                if ($linkedThrough && in_array(strtolower($linkedThrough), $adsTypes)) {
                    $type = 'ADDS';
                }
            }

            // Format created_at to dd/mm/yyyy
            $createdAtFormatted = $user->created_at ? $user->created_at->format('d/m/Y') : null;

            return [
                'name' => $user->name,
                'created_at' => $createdAtFormatted,
                'linked_through' => $linkedThrough,
                'type' => $type,
            ];
        });

        return response()->json($report);
    }
    public function getDestinationCountries()
    {
        try {
            // Fetch the data with aliasing for 'plan-to-study'
            $data = CourseInfo::select(
                'course_details_formdata.plan-to-study as plan_to_study',
                'personal_infos.gender'
            )
                ->join('personal_infos', 'course_details_formdata.user_id', '=', 'personal_infos.user_id')
                ->get();

            $countryStats = [];

            foreach ($data as $record) {
                $rawCountries = $record->plan_to_study;

                // If it's a string, decode it; if it's already an array, cast it
                $countries = is_string($rawCountries)
                    ? json_decode($rawCountries, true)
                    : (array) $rawCountries;

                if (!is_array($countries)) {
                    continue;
                }

                $gender = strtolower(trim($record->gender ?? 'others')); // normalize

                foreach ($countries as $country) {
                    $country = trim($country);

                    if (empty($country)) {
                        continue;
                    }

                    // Normalize 'others' country label
                    if (strtolower($country) === 'others' || strtolower($country) === 'other') {
                        $country = 'Others';
                    }

                    // Initialize record
                    if (!isset($countryStats[$country])) {
                        $countryStats[$country] = [
                            'female' => 0,
                            'male' => 0,
                            'others' => 0,
                            'total_students' => 0
                        ];
                    }

                    // Count by gender
                    if ($gender === 'female') {
                        $countryStats[$country]['female']++;
                    } elseif ($gender === 'male') {
                        $countryStats[$country]['male']++;
                    } else {
                        $countryStats[$country]['others']++;
                    }

                    $countryStats[$country]['total_students']++;
                }
            }

            // Format for response
            $result = array_map(function ($country, $stats) {
                return [
                    'country' => $country,
                    'female' => $stats['female'],
                    'male' => $stats['male'],
                    'others' => $stats['others'],
                    'total_students' => $stats['total_students']
                ];
            }, array_keys($countryStats), $countryStats);

            // Sort descending by total
            usort($result, function ($a, $b) {
                return $b['total_students'] <=> $a['total_students'];
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

    public function getCityStats()
    {
        $data = PersonalInfo::select(
            'city',
            'state',
            DB::raw("SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) as female"),
            DB::raw("SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) as male"),
            DB::raw("SUM(CASE WHEN gender = 'Others' THEN 1 ELSE 0 END) as others"),
            DB::raw("COUNT(*) as total")
        )
            ->groupBy('city', 'state')
            ->get();

        return response()->json($data);
    }


    public function downloadUserProfileReportPDF()
    {

        ini_set('memory_limit', '2048M'); // or -1 for unlimited, if server allows
        set_time_limit(600); // seconds (10 minutes)

        $users = User::all();

        // --- 1. User Profile Report ---
        $userProfileReport = $users->map(function ($user) {
            $personalInfo = PersonalInfo::where('user_id', $user->unique_id)->first();
            $courseInfo = CourseInfo::where('user_id', $user->unique_id)->first();

            $age = null;
            if ($personalInfo && $personalInfo->dob) {
                try {
                    $age = Carbon::parse($personalInfo->dob)->age;
                } catch (\Exception $e) {
                    $age = null;
                }
            }

            $degreeTypeRaw = $courseInfo?->{'degree-type'};
            $degreeType = $degreeTypeRaw ? match (strtolower($degreeTypeRaw)) {
                'masters' => 'Post Graduate',
                'bachelors' => 'Under Graduate',
                default => 'Others',
            }
                : null;

            $planToStudy = null;
            if ($courseInfo && $courseInfo->{'plan-to-study'}) {
                $planToStudyRaw = $courseInfo->{'plan-to-study'};

                if (is_string($planToStudyRaw)) {
                    $decoded = json_decode($planToStudyRaw, true);
                    $planToStudy = is_array($decoded) ? implode(', ', $decoded) : $planToStudyRaw;
                } elseif (is_array($planToStudyRaw)) {
                    $planToStudy = implode(', ', $planToStudyRaw);
                } else {
                    $planToStudy = $planToStudyRaw;
                }
            }


            return [
                'name' => $user->name,
                'unique_id' => $user->unique_id,
                'referral_code' => $user->referral_code,
                'gender' => $personalInfo?->gender,
                'age' => $age,
                'degree_type' => $degreeType,
                'plan_to_study' => $planToStudy,
            ];
        });

        // --- 2. Download Progress Report ---
        $downloadProgressReport = $users->map(function ($user) {
            $personalInfo = PersonalInfo::where('user_id', $user->unique_id)->first();
            $linkedThrough = $personalInfo?->linked_through;

            $type = null;
            if (!empty($user->referral_code)) {
                $type = 'SC Referral';
            } elseif ($linkedThrough && in_array(strtolower($linkedThrough), ['instagram', 'social', 'youtube', 'facebook', 'twitter', 'google'])) {
                $type = 'ADDS';
            }

            $createdAtFormatted = $user->created_at ? $user->created_at->format('d/m/Y') : null;

            return [
                'name' => $user->name,
                'created_at' => $createdAtFormatted,
                'linked_through' => $linkedThrough,
                'type' => $type,
            ];
        });

        // --- 3. Destination Countries Report ---
        $destinationData = CourseInfo::select('course_details_formdata.plan-to-study', 'personal_infos.gender')
            ->join('personal_infos', 'course_details_formdata.user_id', '=', 'personal_infos.user_id')
            ->get();

        $countryStats = [];

        foreach ($destinationData as $record) {
            $planToStudyRaw = $record->{'plan-to-study'};
            $countries = is_string($planToStudyRaw) ? json_decode($planToStudyRaw, true) : $planToStudyRaw;

            if (!is_array($countries)) {
                continue;
            }

            $gender = strtolower(trim($record->gender));

            foreach ($countries as $country) {
                $country = trim($country);
                if (empty($country))
                    continue;

                if (strtolower($country) === 'others' || strtolower($country) === 'other') {
                    $country = 'Others';
                }

                $countryStats[$country] ??= ['female' => 0, 'male' => 0, 'others' => 0, 'total_students' => 0];

                match ($gender) {
                    'female' => $countryStats[$country]['female']++,
                    'male' => $countryStats[$country]['male']++,
                    default => $countryStats[$country]['others']++,
                };

                $countryStats[$country]['total_students']++;
            }
        }


        $destinationCountries = collect($countryStats)
            ->map(fn ($stats, $country) => array_merge(['country' => $country], $stats))
            ->sortByDesc('total_students')
            ->values();

        // --- 4. City Stats Report ---
        $cityStats = PersonalInfo::select(
            'city',
            'state',
            DB::raw("SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) as female"),
            DB::raw("SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) as male"),
            DB::raw("SUM(CASE WHEN gender = 'Others' THEN 1 ELSE 0 END) as others"),
            DB::raw("COUNT(*) as total")
        )
            ->groupBy('city', 'state')
            ->get();

        // --- 5. Timestamp Data ---
        $exportDate = Carbon::now()->format('d-m-Y');
        $exportTime = Carbon::now()->format('h:i A');
        $exportMonth = Carbon::now()->format('F');



        $referralsReport = User::whereNotNull('referral_code')
            ->get()
            ->filter(function ($student) {
                return Scuser::find($student->referral_code); // only if referral_code exists in Scuser
            })
            ->map(function ($student) {
                $referrer = Scuser::find($student->referral_code);
                $courseInfo = CourseInfo::where('user_id', $student->unique_id)->first();

                $degreeTypeRaw = $courseInfo?->{'degree-type'};
                $degreeType = $degreeTypeRaw ? match (strtolower($degreeTypeRaw)) {
                    'masters' => 'Post Graduate',
                    'bachelors' => 'Under Graduate',
                    default => 'Others',
                }
                    : 'N/A';

                return [
                    'referrer_name' => $referrer->full_name,
                    'referrer_code' => $referrer->referral_code,
                    'student_name' => $student->name,
                    'student_id' => $student->unique_id,
                    'degree_type' => $degreeType,
                    'created_at' => $student->created_at?->format('d/m/Y') ?? 'N/A',
                ];
            })
            ->values();





        $userReport = $users->flatMap(function ($user) {
            $personalInfo = $user->personalInfo;
            $courseInfo = $user->courseInfo()->first();

            // Age calculation
            $age = null;
            if ($personalInfo && $personalInfo->dob) {
                try {
                    $age = Carbon::parse($personalInfo->dob)->age;
                } catch (\Exception $e) {
                    $age = null;
                }
            }

            // Degree type mapping once per user
            $degreeTypeRaw = $courseInfo?->{'degree-type'} ?? null;
            $degreeType = $degreeTypeRaw ? match (strtolower($degreeTypeRaw)) {
                'masters' => 'Post Graduate',
                'bachelors' => 'Under Graduate',
                default => 'Others',
            }
                : null;

            // Get proposal records of type 'proposal'
            $proposalRecords = $user->requestProgress()
                ->where('type', Requestprogress::TYPE_PROPOSAL)
                ->get();

            if ($proposalRecords->isEmpty()) {
                // No proposals for user — return one row with null date and status but with degree type
                return [
                    [
                        'nbfcname' => null,
                        'name' => $user->name,
                        'uniqueid' => $user->unique_id,
                        'status' => null,
                        'date' => null,
                        'degreetype' => $degreeType,
                        'age' => $age,
                    ]
                ];
            }

            // Map each proposal — include degreeType from user, status and date from proposal
            return $proposalRecords->map(function ($rp) use ($user, $degreeType, $age) {
                $nbfcName = $rp->nbfc?->nbfc_name ?? null;
                $status = $rp->status ?? null;
                $date = $rp->date ? Carbon::parse($rp->date)->format('d/m/Y') : null;

                return [
                    'nbfcname' => $nbfcName,
                    'name' => $user->name,
                    'uniqueid' => $user->unique_id,
                    'status' => $status,
                    'date' => $date,
                    'degreetype' => $degreeType,
                    'age' => $age,
                ];
            });
        });

        PDF::setBinary('"C:\\Program Files\\wkhtmltopdf\\bin\\wkhtmltopdf.exe"');


        $pdf = PDF::loadView('reports.user-profile', compact(
            'userProfileReport',
            'downloadProgressReport',
            'destinationCountries',
            'cityStats',
            'exportDate',
            'exportTime',
            'exportMonth',
            'referralsReport',
            'userReport'
        ))->setPaper('a4', 'portrait');


        return $pdf->download('user_profile_report_' . now()->format('Ymd_His') . '.pdf');
        // return view('reports.user-profile', compact(
        //     'userProfileReport',
        //     'downloadProgressReport',
        //     'destinationCountries',
        //     'cityStats',
        //     'exportDate',
        //     'exportTime',
        //     'exportMonth',
        //     'referralsReport',
        //     'userReport'
        // ));

    }



    public function getLanding()
    {
        $landing = CmsContent::get();
        return response()->json($landing);
    }

    public function updateLanding(Request $request)
    {
        $landing = landingpage::first(); // or find($id)

        $landing->update($request->only([
            'banner_header',
            'banner_little_quote',
            'banner_little_description',
            'button_textcontent',
            'video_trigger_button'
        ]));

        return response()->json(['message' => 'Updated successfully']);
    }

    public function forgotAdminCredential(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'currentPassword' => 'required|string',
            'newPassword' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $email = $request->email;
        $currentPassword = $request->currentPassword;
        $newPassword = $request->newPassword;


        $superAdminEmail = config('admin.superadmin_email', '');


        if (!empty($superAdminEmail) && $email === $superAdminEmail) {
            return response()->json([
                'message' => 'Super admin password cannot be changed via this route.'
            ], 403);
        }

        // Look for normal admin in DB
        $user = Admin::where('email', $email)->first();

        if (!$user || !Hash::check($currentPassword, $user->password)) {
            return response()->json([
                'message' => 'Invalid email or current password'
            ], 401);
        }

        $user->password = Hash::make($newPassword);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully.'
        ]);
    }




    // public function TestimonialIndex()
    // {
    //     $testimonials = Testimonial::all();
    //     $study_loan = StudyLoanStep::all();
    //     $testimonialIndex = CmsContent::where("title", "Testimonials")->first();

    //     // Parse field_8 JSON
    //     $initialProfile = [];
    //     if ($testimonialIndex && !empty($testimonialIndex->field_8)) {
    //         $initialProfileArray = json_decode($testimonialIndex->field_8, true);
    //         $initialProfile = $initialProfileArray[0] ?? null;
    //     }

    //     return view('pages.landing', compact('testimonials', 'study_loan', 'testimonialIndex', 'initialProfile'));
    // }


    public function TestimonialIndex(Request $request)
    {
        $testimonials = Testimonial::all();
        $study_loan = StudyLoanStep::all();
        $testimonialIndex = CmsContent::where("title", "Testimonials")->first();
        $landingpageContents = CmsContent::get();
        

        // 1. Parse CMS testimonials
        $initialProfiles = [];
        if ($testimonialIndex && !empty($testimonialIndex->content)) {
            $decoded = json_decode($testimonialIndex->content, true);
            if (is_array($decoded)) {
                $initialProfiles = $decoded;
            }
        }

        // 2. DB Testimonials
        $dbTestimonials = $testimonials->map(function ($item) {
            return [
                'name' => $item->name,
                'designation' => $item->designation,
                'rating' => $item->rating,
                'description' => $item->review,
                'image' => $item->image ?? '/images/default-profile.png',
            ];
        })->toArray();

        $combinedTestimonials = array_merge($initialProfiles, $dbTestimonials);

        // 3. FAQs: CMS + DB
        $faqContent = CmsContent::where("title", "Landing Page")->first();
        $initialFaqs = [];
        if ($faqContent && !empty($faqContent->field_78)) {
            $decodedFaqs = json_decode($faqContent->field_78, true);
            if (is_array($decodedFaqs)) {
                $initialFaqs = $decodedFaqs;
            }
        }

        $dbFaqs = Faq::all()->map(function ($faq) {
            return [
                'question' => $faq->question,
                'answer' => $faq->answer,
                'date' => $faq->created_at->format('Y-m-d')
            ];
        })->toArray();

        $combinedFaqs = array_merge($initialFaqs, $dbFaqs);

        // ✅ 4. Logos: CMS + DB
        $logoContent = CmsContent::where("title", "seedPartnerLogo")->first();

        $initialLogos = [];

        if ($logoContent) {
            $initialLogos[] = [
                'url' => $logoContent->content,
                'title' => $logoContent->title,
                'id' => $logoContent->id // No DB ID for CMS entry
            ];
        }

        // Now fetch all partner logos from DB
        $dbLogos = PartnerLogo::all()->map(function ($logo) {
            return [
                'url' => $logo->content,
                'title' => $logo->title,
                'id' => $logo->id,
            ];
        })->toArray();

        // Merge both
        $combinedLogos = array_merge($initialLogos, $dbLogos);


        // ✅ Return to view
        return view('pages.landing', compact(
            'testimonials',
            'study_loan',
            'testimonialIndex',
            'combinedTestimonials',
            'landingpageContents',
            'combinedFaqs',
            'combinedLogos'
        ));

        // return response()->json([
      
        //     'combinedLogos' => $combinedLogos
        // ]);
    }






    public function TestimonialCMS()
    {
        $testimonials = Testimonial::all();

        return response()->json([
            'status' => true,
            'message' => 'Testimonials fetched successfully',
            'data' => $testimonials
        ]);
    }
    public function TestimonialFaqs()
    {
        $faqs = Faq::all();

        return response()->json([
            'status' => true,
            'data' => $faqs
        ]);
    }
    public function CMSLogos()
    {
        $Logos = PartnerLogo::all();

        return response()->json([
            'status' => true,
            'data' => $Logos
        ]);
    }
    public function updateTestimonial(Request $request, $id)
    {
        $testimonial = Testimonial::find($id);

        if (!$testimonial) {
            return response()->json([
                'status' => false,
                'message' => 'Testimonial not found'
            ], 404);
        }

        $testimonial->update($request->only([
            'name',
            'designation',
            'review',
            'image',
            'rating'
        ]));

        return response()->json([
            'status' => true,
            'message' => 'Testimonial updated successfully',
            'data' => $testimonial
        ]);
    }

    public function deleteTestimonial($id)
    {
        $testimonial = Testimonial::find($id);

        if (!$testimonial) {
            return response()->json([
                'status' => false,
                'message' => 'Testimonial not found'
            ], 404);
        }

        $testimonial->delete();

        return response()->json([
            'status' => true,
            'message' => 'Testimonial deleted successfully'
        ]);
    }
    public function storeTestimonial(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'review' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5'
        ]);

        $testimonial = Testimonial::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'review' => $request->review,
            'rating' => $request->rating,
            'image' => $request->image ?? null // optional image
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Testimonial created successfully',
            'data' => $testimonial
        ]);
    }








    public function TestimonialStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
            'image' => 'nullable'
        ]);


        Testimonial::create($data);

        return response()->json(['message' => 'Testimonial added!'], 201);
    }
    public function updateHeroContent(Request $request)
    {
        $request->validate([
            'key_name' => 'required|string|exists:cms_contents,key_name',
            'content' => 'nullable|string'
        ]);

        // Fetch the row
        $cmsItem = CmsContent::where('key_name', $request->key_name)->first();

        // Optional: validate against maxLength if present in constraints
        $constraints = $cmsItem->constraints ?? [];
        if (!empty($constraints['maxLength']) && strlen($request->content) > $constraints['maxLength']) {
            return response()->json(['message' => 'Content exceeds allowed length'], 422);
        }

        // Update content
        $cmsItem->content = $request->content;
        $cmsItem->save();

        return response()->json(['message' => 'Content updated successfully']);
    }



    public function updateCmsImageContent(Request $request)
    {
        $request->validate([
            'file' => 'required|image', // ✅ image only
            'title' => 'required|string'
        ]);

        $file = $request->file('file');
        $title = Str::slug($request->input('title')); // folder name
        $originalTitle = $request->input('title');     // exact title for DB match

        $fileName = $file->getClientOriginalName();
        $fileDirectory = "cms_uploads/{$title}";

        // Remove existing files in that folder
        $existingFiles = Storage::disk('s3')->files($fileDirectory);
        if (!empty($existingFiles)) {
            Storage::disk('s3')->delete($existingFiles);
        }

        // Store the new file
        $filePath = $file->storeAs(
            $fileDirectory,
            time() . '-' . $fileName,
            [
                'disk' => 's3',
                'visibility' => 'public',
            ]
        );

        $fileUrl = Storage::disk('s3')->url($filePath);

        // Find CMS content by title
        $cmsContent = CmsContent::where('title', $originalTitle)->first();

        if (!$cmsContent) {
            return response()->json([
                'message' => "CMS content with title '{$originalTitle}' not found."
            ], 404);
        }

        // Update the content with new file URL
        $cmsContent->content = $fileUrl;
        $cmsContent->save();

        return response()->json([
            'message' => 'Media uploaded and content updated successfully!',
            'file_url' => $fileUrl,
        ], 200);
    }



    public function storeFaq(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string'
        ]);

        $faq = Faq::create($request->only(['question', 'answer']));

        return response()->json([
            'status' => true,
            'message' => 'FAQ created successfully',
            'data' => $faq
        ]);
    }
    public function updateFaq(Request $request, $id)
    {
        $faq = Faq::find($id);

        if (!$faq) {
            return response()->json(['status' => false, 'message' => 'FAQ not found'], 404);
        }

        $faq->update($request->only(['question', 'answer']));

        return response()->json([
            'status' => true,
            'message' => 'FAQ updated successfully',
            'data' => $faq
        ]);
    }
    public function deleteFaq($id)
    {
        $faq = Faq::find($id);

        if (!$faq) {
            return response()->json(['status' => false, 'message' => 'FAQ not found'], 404);
        }

        $faq->delete();

        return response()->json(['status' => true, 'message' => 'FAQ deleted successfully']);
    }


    public function uploadLogo(Request $request, $partnerId)
    {
        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'No file provided.'], 400);
        }

        $file = $request->file('file');

        // Generate file name like: logo.png
        $extension = $file->getClientOriginalExtension();
        $fileName = "logo.{$extension}";
        $path = "cms_uploads/logopartner/{$partnerId}/{$fileName}";

        // Upload to S3
        Storage::disk('s3')->put($path, file_get_contents($file), [
            'visibility' => 'public',
            'ContentType' => $file->getMimeType(),
        ]);

        $fileUrl = Storage::disk('s3')->url($path);

        // Save to DB (update if already exists for this partner)
        $logo = PartnerLogo::updateOrCreate(
            ['title' => 'Partner Logo ' . $partnerId, 'content' => $fileUrl]
        );


        return response()->json([
            'success' => true,
            'url' => $fileUrl,
            'logo' => $logo
        ]);
    }


    public function listLogos($partnerId)
    {
        $directory = "cms_uploads/logopartner/{$partnerId}";
        $files = Storage::disk('s3')->files($directory);

        $urls = array_map(fn ($file) => Storage::disk('s3')->url($file), $files);

        return response()->json(['files' => $urls]);
    }
    public function deleteLogo($partnerId)
    {
        $fileName = 'logo.png'; // assuming consistent filename
        $path = "cms_uploads/logopartner/{$partnerId}/{$fileName}";

        if (!Storage::disk('s3')->exists($path)) {
            return response()->json(['error' => 'File not found.'], 404);
        }

        Storage::disk('s3')->delete($path);

        return response()->json(['success' => true, 'message' => 'File deleted successfully.']);
    }
}
