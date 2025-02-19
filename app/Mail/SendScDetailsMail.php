<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendScDetailsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $referralCode;
    public $password;

    /**
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     *  @return void
     */
    public function __construct($referralCode,$password)
    {
        $this->referralCode = $referralCode;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Unique Referral Code')
            ->view('email.StudentCounsellerEmail', [
                'referralCode' => $this->referralCode,
                'password'=>$this->password,
            ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
