<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use ZipArchive;
use App\Mail\SendDocumentsMail;
use App\Models\Nbfc;

class ProcessUserDocuments implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $userId;
    public string $borrower;

    /**
     * Create a new job instance.
     */
    public function __construct(string $userId, string $borrower)
    {
        $this->userId = $userId;
        $this->borrower = $borrower;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $base = "{$this->userId}/static";
        $folders = Storage::disk('s3')->directories($base);
        $fileList = [];

        foreach ($folders as $folder) {
            try {
                foreach (Storage::disk('s3')->files($folder) as $file) {
                    $fileList[] = $file;
                }
            } catch (\Throwable $e) {
                \Log::error("S3 list error in [$folder]: {$e->getMessage()}");
            }
        }

        if (empty($fileList)) return;

        $localDir = storage_path('app/temp');
        if (!is_dir($localDir)) mkdir($localDir, 0755, true);

        $zipName = 'documents_' . Str::random(10) . '.zip';
        $localZip = "$localDir/$zipName";
        $zip = new ZipArchive;

        if ($zip->open($localZip, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) return;

        foreach ($fileList as $s3Path) {
            $zip->addFromString(basename($s3Path), Storage::disk('s3')->get($s3Path));
        }
        $zip->close();

        $s3Path = "zips/$zipName";
        Storage::disk('s3')->put($s3Path, fopen($localZip, 'r'), ['ACL' => 'public-read']);
        $zipUrl = Storage::disk('s3')->url($s3Path);

        $nbfcs = Nbfc::where('status', 'active')->get(['nbfc_name', 'nbfc_email']);

        foreach ($nbfcs as $nbfc) {
            Mail::to($nbfc->nbfc_email)->send(
                new SendDocumentsMail($zipUrl, $this->borrower, $nbfc->nbfc_name)
            );
        }

        unlink($localZip);
    }
}