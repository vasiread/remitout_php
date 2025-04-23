<?php

namespace App\Http\Controllers;

use App\Models\proposalcompletion;
use App\Models\Proposals;
use App\Models\Rejectedbynbfc;
use App\Models\Requestedbyusers;
use App\Models\Requestprogress;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

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
}
