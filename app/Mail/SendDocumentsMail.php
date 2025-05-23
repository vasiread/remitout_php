<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendDocumentsMail extends Mailable
{
    use Queueable, SerializesModels;

      public $zipUrl;
    public $name;

    public function __construct($zipUrl, $name)
    { 

       $this->zipUrl = $zipUrl;
        $this->name = $name;


    }

    public function build()
     {
        return $this->subject('Your Documents Are Ready')
            ->view('email.email')
            ->with([
                'name' => $this->name,
                'zipUrl' => $this->zipUrl,
            ]);
    }
    
}
