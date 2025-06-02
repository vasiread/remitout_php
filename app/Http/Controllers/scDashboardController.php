<?php
namespace App\Http\Controllers;

use App\Exports\UserStatusesExport;
use App\Mail\ForgotPassword;
use App\Mail\SendScDetailsMail;
use App\Models\Queries;
use App\Models\Requestprogress;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;
use App\Models\PersonalInfo;
use App\Models\Scuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Psy\Readline\Hoa\Console;



class scDashboardController extends Controller
{

    public function getUsersByCounsellor()
    {
        $referralId = "HYU67994003";

        $userByRef = PersonalInfo::where('referral_code', $referralId)->get();
        $scDetail = Scuser::where('referral_code', $referralId)->get();

        if ($userByRef->isEmpty() || $scDetail->isEmpty()) {
            return response()->json([
                'error' => 'No users found for the given referral code.',
                'referral_code' => $referralId,
                'users_found' => false
            ], 404);
        }

        return $userByRef;
    }
    public function getUsersByCounsellorApi(Request $request)
    {
        $request->validate([
            'referralId' => 'string|required'
        ]);

        $referralId = $request->input('referralId');



        $userByRef = User::where('referral_code', $referralId)->get();
        $scDetail = Scuser::where('referral_code', $referralId)->get();

        if ($userByRef->isEmpty() || $scDetail->isEmpty()) {
            return response()->json([
                'error' => 'No users found for the given referral code.',
                'referral_code' => $referralId,
                'users_found' => false
            ], 404);
        }

        return $userByRef;
    }

    public function uploadScUserPhoto(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,gif|max:2048',  // Validate file type and size (2MB max)
            'scuserrefid' => 'required|string',
        ]);

        $screfId = $request->input('scuserrefid');

        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = $file->getClientOriginalName();
                $fileDirectory = "Student_Counsellor/$screfId/Profile_photoes";

                // Delete existing files in the directory
                $existingFiles = Storage::disk('s3')->files($fileDirectory);
                if (!empty($existingFiles)) {
                    Storage::disk('s3')->delete($existingFiles);
                }

                // Store the new file
                $filePath = $file->storeAs(
                    $fileDirectory,
                    $fileName,
                    [
                        'disk' => 's3',
                        'visibility' => 'public',
                    ]
                );

                // Retrieve the file's public URL
                $fileUrl = Storage::disk('s3')->url($filePath);

                return response()->json([
                    'message' => 'File uploaded successfully!',
                    'file_name' => $fileName,
                    'file_path' => $fileUrl,
                ], 200);
            }

            return response()->json([
                'message' => 'No file uploaded.',
            ], 400);
        } catch (\Exception $e) {
            \Log::error('Error uploading file: ' . $e->getMessage());

            return response()->json([
                'message' => 'File upload failed.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function uploadScUserInfo(Request $request)
    {
        $request->validate([
            'scUserName' => 'string|required',
            'scDob' => 'string|required',
            'scEmail' => 'string|required|email',
            'scContact' => 'string|required',
            'scAddress' => 'string|required',
            'profilePhoto' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $password = Str::random(12);
            $hashedPassword = Hash::make($password);

            $referralCode = 'SCREF' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
            while (Scuser::where('referral_code', $referralCode)->exists()) {
                $referralCode = 'SCREF' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
            }

            $scUser = Scuser::create([
                'referral_code' => $referralCode,
                'full_name' => $request->input('scUserName'),
                'dob' => $request->input('scDob'),
                'email' => $request->input('scEmail'),
                'phone' => $request->input('scContact'),
                'address' => $request->input('scAddress'),
                'passwordField' => $hashedPassword,
                'street' => '',
                'district' => '',
                'state' => '',
                'pincode' => ''
            ]);

            $fileUrl = null;

            if ($scUser) {
                if ($request->hasFile('profilePhoto')) {
                    $file = $request->file('profilePhoto');
                    $fileName = $file->getClientOriginalName();
                    $fileDirectory = "Student_Counsellor/$referralCode/Profile_photoes";


                    $existingFiles = Storage::disk('s3')->files($fileDirectory);
                    if (!empty($existingFiles)) {
                        Storage::disk('s3')->delete($existingFiles);
                    }

                    $filePath = $file->storeAs(
                        $fileDirectory,
                        $fileName,
                        [
                            'disk' => 's3',
                            'visibility' => 'public',
                        ]
                    );

                    $fileUrl = Storage::disk('s3')->url($filePath); // Get the file URL
                }

                Mail::to($request->input('scEmail'))->send(new SendScDetailsMail($referralCode, $password));
            }

            return response()->json([
                'message' => 'User information successfully uploaded and password sent!',
                'scUser' => $scUser,
                'profilePhoto' => $fileUrl
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getScAllUsers()
    {

        try {
            $scuser = Scuser::where('status', 'active')
                ->get();

            return response()->json([
                'success' => true,
                'receivedData' => $scuser
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching data',
                'error' => $e->getMessage()
            ], 500);
        }


    }


    public function retrieveOneScUser(Request $request)
    {

        $request->validate([
            'referral_code' => 'required|string'
        ]);

        $scuser = Scuser::where('referral_code', $request->input("referral_code"))->first();

        return $scuser;


    }

    public function getStatusOfUsers(Request $request)
    {
        try {
            $request->validate([
                'scReferralId' => 'required|string',
            ]);

            $scUserId = $request->input('scReferralId');

            $users = DB::table('users')->where('referral_code', $scUserId)->get();

            if ($users->isEmpty()) {
                return response()->json(['message' => 'No user found for this referral'], 404);
            }

            Log::info('Found users:', $users->toArray());

            $allStatuses = [];
            $userIds = [];

            foreach ($users as $user) {
                $userId = $user->unique_id;
                $userName = $user->name;
                $userIds[] = $userId;

                $Accepted = DB::table('traceprogress')
                    ->join('nbfc', 'traceprogress.nbfc_id', '=', 'nbfc.nbfc_id')
                    ->where('traceprogress.user_id', $userId)
                    ->where('traceprogress.type', 'proposal') // Only proposals
                    ->where('traceprogress.reviewed', 1)      // Only accepted ones
                    ->whereNotNull('traceprogress.created_at')
                    ->select(
                        'nbfc.nbfc_name',
                        'traceprogress.created_at',
                        DB::raw("'Accepted' as status_type"),
                        'traceprogress.user_id'
                    )
                    ->get();



                $Pending = DB::table('requestedbyusers')
                    ->join('nbfc', 'requestedbyusers.nbfcid', '=', 'nbfc.nbfc_id')
                    ->where('requestedbyusers.userid', $userId)
                    ->select(
                        'nbfc.nbfc_name',
                        'requestedbyusers.created_at',
                        DB::raw("'Pending' as status_type"),
                        'requestedbyusers.userid as user_id'
                    )
                    ->get();

                $Rejected = DB::table('rejectedbynbfc')
                    ->join('nbfc', 'rejectedbynbfc.nbfc_id', '=', 'nbfc.nbfc_id')
                    ->where('rejectedbynbfc.user_id', $userId)
                    ->select(
                        'nbfc.nbfc_name',
                        'rejectedbynbfc.created_at',
                        DB::raw("'Rejected' as status_type"),
                        'rejectedbynbfc.user_id'
                    )
                    ->get();

                $merged = collect($Accepted)->merge($Pending)->merge($Rejected);

                foreach ($merged as $status) {
                    $allStatuses[] = [
                        'user_id' => $status->user_id,
                        'nbfc_name' => $status->nbfc_name,
                        'userName' => $userName,
                        'status_type' => $status->status_type,
                        'created_at' => $status->created_at,
                    ];
                }
            }

            if (empty($allStatuses)) {
                return response()->json(['message' => 'No statuses found for users'], 404);
            }

            // Grouping: user_id -> nbfc_name -> statuses (newest first)
            $grouped = collect($allStatuses)
                ->groupBy('user_id')
                ->map(function ($userStatuses, $userId) {
                    $userName = $userStatuses->first()['userName'] ?? null;

                    $nbfcGrouped = collect($userStatuses)
                        ->groupBy('nbfc_name')
                        ->map(function ($statuses, $nbfcName) {
                            $statusList = collect($statuses)
                                ->sortByDesc(function ($status) {
                                    return $status['created_at'] ?? '0000-00-00 00:00:00';
                                })
                                ->map(function ($status) {
                                    return [
                                        'status_type' => $status['status_type'],
                                        'created_at' => $status['created_at'],
                                    ];
                                })
                                ->values();

                            return [
                                'nbfc_name' => $nbfcName,
                                'statuses' => $statusList,
                            ];
                        })
                        ->values();

                    return [
                        'user_id' => $userId,
                        'userName' => $userName,
                        'nbfcs' => $nbfcGrouped,
                    ];
                })
                ->values();

            // Count all proposals for all users
            $ProposalCount = DB::table('traceprogress')
                ->whereIn('traceprogress.user_id', $userIds)
                ->count();

            return response()->json([
                'success' => true,
                'data' => $grouped,
                'proposalCount' => $ProposalCount,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving status',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function retrieveScProfilePicture(Request $request)
    {
        $request->validate([
            'scuserrefid' => 'required|string',
        ]);

        $scuserrefid = $request->input('scuserrefid');

        $filePath = "Student_Counsellor/$scuserrefid/Profile_photoes";

        $files = Storage::disk('s3')->files($filePath);

        if (!empty($files)) {
            $file = $files[0];

            $fileUrl = Storage::disk('s3')->url($file);

            return response()->json([
                'message' => 'Profile picture retrieved successfully.',
                'fileUrl' => $fileUrl,
            ], 200);
        }

        return response()->json([
            'message' => 'No profile picture found for this user.',
        ], 404);
    }


    public function uploadScUserDetails(Request $request)
    {
        $request->validate([
            'scRefNo' => 'required|string',
            'updatedScName' => 'nullable|string',
            'updatedScDob' => 'nullable|string',
            'updatedScPhone' => 'nullable|string',
            'street' => 'nullable|string',
            'district' => 'nullable|string',
            'state' => 'nullable|string',
            'pincode' => 'nullable|string'
        ]);

        try {
            $studentCounsellor = Scuser::where('referral_code', $request->input('scRefNo'))->first();

            if ($studentCounsellor) {
                if ($request->has('updatedScName')) {
                    $studentCounsellor->full_name = $request->input('updatedScName');
                }
                if ($request->has('updatedScDob')) {
                    $studentCounsellor->dob = $request->input('updatedScDob');
                }
                if ($request->has('updatedScPhone')) {
                    $studentCounsellor->phone = $request->input('updatedScPhone');
                }
                if ($request->has('street')) {
                    $studentCounsellor->street = $request->input('street');
                }
                if ($request->has('district')) {
                    $studentCounsellor->district = $request->input('district');
                }
                if ($request->has('state')) {
                    $studentCounsellor->state = $request->input('state');
                }
                if ($request->has('pincode')) {
                    $studentCounsellor->pincode = $request->input('pincode');
                }

                $fullAddress = $request->input('street') . ', ' . $request->input('district') . ', ' . $request->input('state') . ' - ' . $request->input('pincode');

                if ($fullAddress) {
                    $studentCounsellor->address = $fullAddress;
                }


                // Save the updated data
                $studentCounsellor->save();



                return response()->json([
                    'success' => true,
                    'message' => 'Student counsellor details updated successfully',
                ], 200);
            } else {
                return response()->json([
                    'error' => 'Student counsellor not found',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while updating the details.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }




    public function import_excel_post(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx'
        ]);

        try {
            // Create an instance of StudentsImport with a skipped count
            $import = new StudentsImport();
            Excel::import($import, $request->file('excel_file'));

            // Get the count of skipped rows (duplicate emails)
            $skippedRows = $import->getSkippedRows();

            if ($skippedRows > 0) {
                return response()->json([
                    'success' => true,
                    'message' => 'Import completed, but some entries were skipped due to existing emails.',
                    'skipped_rows' => $skippedRows
                ], 200);
            }

            return response()->json([
                'success' => true,
                'message' => 'All students were registered successfully.',
            ], 200);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) { // Duplicate entry error
                return response()->json([
                    'success' => false,
                    'message' => 'Duplicate entry found. Please check your file for existing student data.'
                ], 400);
            }

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while importing the file. Please try again.'
            ], 500);
        }
    }





    public function getScuserQueryRaised(Request $request)
    {
        try {
            $request->validate([
                'scUserId' => 'string|required'
            ]);

            $scUserId = $request->input('scUserId');

            $queries = Queries::where('scuserid', $scUserId)
                ->select('id', 'queryraised', 'querytype', 'created_at', 'is_reviewed', 'status')
                ->get();

            return response()->json([
                'success' => true,
                'queries' => $queries,
                'message' => "Successfully fetched queries"
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving queries.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getScUserTickets()
    {
        try {




            $queries = Queries::where('status', 'active')->get();

            return response()->json([
                'success' => true,
                'queries' => $queries,
                'message' => "successfully fetched Queries"

            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An Error Occured While retrieve scuser queries',
                'error' => $e->getMessage()
            ], 500);
        }

    }
    public function suspendUser(Request $request)
    {
        $referralCode = $request->input('referralCode');

        if (!$referralCode) {
            return response()->json([
                'success' => false,
                'message' => 'Referral code is required.'
            ], 400);
        }

        $scUser = Scuser::where('referral_code', $referralCode)->first();

        if (!$scUser) {
            return response()->json([
                'success' => false,
                'message' => 'Counsellor not found.'
            ], 404);
        }

        try {

            $scUser->status = 'suspended';
            $scUser->save();

            return response()->json([
                'success' => true,
                'message' => 'Counsellor suspended successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error Suspending counsellor: ' . $e->getMessage()
            ], 500);
        }
    }


    public function forgotScCredential(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        Log::info('Requested email: ' . $request->email);


        $user = Scuser::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $newPassword = Str::random(10);

        if ($user->passwordField !== Hash::make($newPassword)) {
            $user->passwordField = Hash::make($newPassword);  // Encrypt password before saving
            $user->save();

            Mail::to($user->email)->send(new ForgotPassword(
                $user->email,
                $user->referral_code,
                $newPassword
            ));

            return response()->json(['message' => 'A new password has been sent to your email.']);
        } else {
            return response()->json(['message' => 'The password has not changed.']);
        }
    }



    public function postQueryScside(Request $request)
    {


        // Validate the incoming request data
        $request->validate([
            'scuserid' => 'required|string',
            'querytype' => 'required|string|max:255',
            'queryraised' => 'required|string',
        ]);

        // Create a new query record
        $query = Queries::create([
            'scuserid' => $request->input('scuserid'),
            'querytype' => $request->input('querytype'),
            'queryraised' => $request->input('queryraised'),
        ]);

        // Return a success response
        return response()->json([
            'message' => 'Query raised successfully!',
            'data' => $query
        ], 201);


    }

    public function downloadExcelStatus(Request $request)
    {
        try {
            $request->validate([
                'scReferralId' => 'required|string',
            ]);

            $scUserId = $request->input('scReferralId');

            $users = DB::table('users')->where('referral_code', $scUserId)->get();

            if ($users->isEmpty()) {
                return response()->json(['message' => 'No user found for this referral'], 404);
            }

            $allStatuses = [];

            foreach ($users as $user) {
                $userId = $user->unique_id;
                $userName = $user->name;

                $Accepted = DB::table('traceprogress')
                    ->join('nbfc', 'traceprogress.nbfc_id', '=', 'nbfc.nbfc_id')
                    ->where('traceprogress.user_id', $userId)
                    ->select(
                        'nbfc.nbfc_name',
                        'traceprogress.created_at',
                        DB::raw("'Accepted' as status_type"),
                        'traceprogress.user_id'
                    )->get();

                $Pending = DB::table('requestedbyusers')
                    ->join('nbfc', 'requestedbyusers.nbfcid', '=', 'nbfc.nbfc_id')
                    ->where('requestedbyusers.userid', $userId)
                    ->select(
                        'nbfc.nbfc_name',
                        'requestedbyusers.created_at',
                        DB::raw("'Pending' as status_type"),
                        'requestedbyusers.userid as user_id'
                    )->get();

                $Rejected = DB::table('rejectedbynbfc')
                    ->join('nbfc', 'rejectedbynbfc.nbfc_id', '=', 'nbfc.nbfc_id')
                    ->where('rejectedbynbfc.user_id', $userId)
                    ->select(
                        'nbfc.nbfc_name',
                        'rejectedbynbfc.created_at',
                        DB::raw("'Rejected' as status_type"),
                        'rejectedbynbfc.user_id'
                    )->get();

                $merged = collect($Accepted)->merge($Pending)->merge($Rejected);

                foreach ($merged as $status) {
                    $allStatuses[] = [
                        'User ID' => $status->user_id,
                        'User Name' => $userName,
                        'NBFC Name' => $status->nbfc_name,
                        'Status Type' => $status->status_type,
                        'Created At' => $status->created_at,
                    ];
                }
            }

            if (empty($allStatuses)) {
                return response()->json(['message' => 'No statuses found for users'], 404);
            }

            // Create CSV streamed response
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="user_statuses.csv"',
            ];

            $callback = function () use ($allStatuses) {
                $file = fopen('php://output', 'w');
                fputcsv($file, ['User ID', 'User Name', 'NBFC Name', 'Status Type', 'Created At']);

                foreach ($allStatuses as $row) {
                    fputcsv($file, $row);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error generating CSV file',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


}
