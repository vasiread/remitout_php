<?php
namespace App\Http\Controllers;

use App\Models\PersonalInfo;
use App\Models\Scuser;
use Illuminate\Http\Request;

class scDashboardController extends Controller
{

    public function getUsersByCounsellor()
    {
        $referralId = "HYU67994003";  // This can come from request input

        // Fetch users by referral code
        $userByRef = PersonalInfo::where('referral_code', $referralId)->get();
        $scDetail = Scuser::where('referral_code', $referralId)->get();

        // Check if collections are empty
        if ($userByRef->isEmpty() || $scDetail->isEmpty()) {
            return response()->json([
                'error' => 'No users found for the given referral code.',
                'referral_code' => $referralId,
                'users_found' => false
            ], 404);
        }

         return $userByRef;
    }



}
