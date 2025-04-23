<?php

namespace App\Http\Controllers;

use App\Models\Nbfc;
use App\Models\PersonalInfo;
use App\Models\proposalcompletion;
use App\Models\Proposals;
use App\Models\Rejectedbynbfc;
use App\Models\Requestedbyusers;
use App\Models\Requestprogress;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

                // Step 1: Count the number of leads for this NBFC
                // Use 'nbfcid' as per the database column name
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

                        // Find the corresponding entry in traceprogress
                        // Use 'userid' and 'nbfcid' as per the database column names
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
                                Log::info("NBFC: {$nbfcName}, User: {$userId}, Days Difference: {$daysDifference}, Request Time: {$requestTime}, Proposal Time: {$proposalTime}");
                            } else {
                                Log::warning("NBFC: {$nbfcName}, User: {$userId}, Invalid timestamps - Request: {$requestTime}, Proposal: {$proposalTime}");
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
}
