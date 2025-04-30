<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $userId;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $userId, $password)
    {
        $this->email = $email;
        $this->userId = $userId;
        $this->password = $password;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */

      public function build()
    {
        return $this->subject('Your Login Credentials')
                    ->view('email.forgot_password')
                    ->with([
                        'email' => $this->email,
                        'userId' => $this->userId,
                        'password' => $this->password,
                    ]);
    }
    public function envelope()
    {
        return new Envelope(
            subject: 'Forgot Password',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'email.forgot_password',
        );
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
