<?php

namespace App\Jobs;

use App\Mail\SendDocumentsMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendDocumentsToNbfcJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $email;
    protected $zipUrl;
    protected $name;
    protected $nbfc_name;

    public function __construct($email, $zipUrl, $name, $nbfc_name)
    {
        $this->email = $email;
        $this->zipUrl = $zipUrl;
        
        $this->name = $name;
        $this->$nbfc_name = $$nbfc_name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new SendDocumentsMail($this->zipUrl, $this->name,$this->nbfc_name));

    }
}
