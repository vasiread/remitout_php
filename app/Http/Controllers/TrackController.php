<?php
namespace App\Http\Controllers;

use App\Models\Nbfc;
use App\Models\Requestprogress;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function loanTracker()
    {
        // Ensure the array is named 'loanStatusInfo'
        $loanStatusInfo = [
            [02, 'Received'],
            [03, 'On Hold'],
            [04, 'Completed']
        ];

        // Pass it to the view correctly using compact
        return view('pages.studentdashboard', compact('loanStatusInfo'));
    }


    public function traceuserprogress(Request $request)
    {

        try {
            $request->validate([
                'nbfc_id' => 'string|required',
            ]);

            $nbfcId = $request->input('nbfc_id');


            $retrievedata = Requestprogress::join('users', 'users.unique_id', '=', 'traceprogress.user_id')
                ->where('traceprogress.nbfc_id', $nbfcId)
                ->select('users.name', 'users.unique_id', 'traceprogress.type', 'traceprogress.nbfc_id')
                ->get();



            return response()->json([
                'success' => 'Data Retrieved',
                'returnValues' => $retrievedata,


            ]);
        } catch (\Exception $e) {
            Log::error('Error updating personal info: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'An error occurred while updating your details.']);
        }



    }

    public function getnbfcdata()
    {
        try {
            $nbfcdata = Nbfc::get();

            return response()->json([
                'success' => true,
                'receivedData' => $nbfcdata
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}

