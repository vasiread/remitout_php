<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Log;
use Storage;
class TermsController extends Controller
{
    public function index()
    {
        return view('pages.terms');
    }

    public function getFirstVideoFromS3()
    {
        try {
            Log::info("Fetching first video from S3...");

             $files = Storage::disk('s3')->files('video/demo video');

            if (empty($files)) {
                return response()->json(['error' => 'No video found.'], 404);
            }

             $firstVideo = $files[0];

            // Generate a temporary signed URL valid for 30 minutes
            $videoUrl = Storage::disk('s3')->temporaryUrl($firstVideo, now()->addMinutes(30));

            return response()->json(['videoUrl' => $videoUrl]);

        } catch (\Exception $e) {
            Log::error("Error fetching video from S3: " . $e->getMessage());

            return response()->json(['error' => 'Failed to load video.'], 500);
        }
    }
}