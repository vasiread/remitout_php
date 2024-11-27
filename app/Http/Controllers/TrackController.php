<?php
namespace App\Http\Controllers;

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
}

