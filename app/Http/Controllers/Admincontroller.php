<?php

namespace App\Http\Controllers;

use App\Models\CourseInfo;
use App\Models\Nbfc;
use App\Models\PersonalInfo;
use App\Models\proposalcompletion;
use App\Models\Proposals;
use App\Models\Rejectedbynbfc;
use App\Models\Requestedbyusers;
use App\Models\Requestprogress;
use App\Models\Scuser;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class Admincontroller extends Controller
{
    public function retrieveDashboardDetails()
    {

        try {
            $offerIssuedStudentsCount = Requestprogress::where("type", "proposal")->count();
            $offerRejectedByStudentCount = proposalcompletion::where("proposal_accept", false)->count();
            $offerAcceptedAndClosedCount = proposalcompletion::where("proposal_accept", true)->count();







            $dashboardDetailsCount = [
                $offerIssuedStudentsCount,
                $offerRejectedByStudentCount,
                $offerAcceptedAndClosedCount,
                // $offerIssedDocumentSubmission




            ];

            return response()->json([
                "message" => true,
                "counts" => $dashboardDetailsCount,
            ]);
        } catch (Exception $e) {
            return response()->json([
                "message" => false,
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
            // Define the days of the week in order (Monday to Sunday)
            $daysOfWeek = [
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday',
                'Sunday'
            ];

            // Fetch the count of users grouped by the day of the week
            $registrationsByDay = User::select(
                DB::raw("DAYNAME(created_at) as day_of_week"),
                DB::raw("COUNT(*) as registration_count")
            )
                ->groupBy(DB::raw("DAYNAME(created_at)"))
                ->pluck('registration_count', 'day_of_week')
                ->toArray();

            // Initialize the counts array with 0 for each day
            $registrationCounts = array_fill(0, 7, 0);

            // Map the counts to the correct day of the week
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

                $userDetails = [
                    'unique_id' => $user->unique_id,
                    'email' => $personalInfo ? $personalInfo->email : null,
                    'full_name' => $personalInfo ? $personalInfo->full_name : null,
                    'gender' => $personalInfo ? $personalInfo->gender : null,
                    'phone_number' => $user->phone,
                    'degree_type' => null,
                    'loan_amount' => null,
                    'course_info' => []
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
                        $userDetails['degree_type'] = $course->{'degree-type'}; // Correct reference
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

}
