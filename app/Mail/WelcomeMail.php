<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $msg;
    public $subject;
    public $attachments; // To hold attachments

    /**
     * Create a new message instance.
     *
     * @param string $msg
     * @param string $subject
     * @param array $attachments
     * @return void
     */
    public function __construct($msg, $subject, $attachments = [])
    {
        $this->msg = $msg;
        $this->subject = $subject;
        $this->attachments = $attachments; // Assign attachments to the instance
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->subject,
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
            view: 'components.mail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        $attachedFiles = [];

        // Attach each file provided in the $attachments array
        foreach ($this->attachments as $attachment) {
            $attachedFiles[] = [
                'file_content' => $attachment['file_content'],
                'file_name' => $attachment['file_name'],
            ];
        }

        // Return the attachments array
        return $attachedFiles;
    }

    /**
     * Build the email message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->view('components.mail')
            ->subject($this->subject)
            ->with('msg', $this->msg);

        // Attach each file
        foreach ($this->attachments as $attachment) {
            $email->attachData($attachment['file_content'], $attachment['file_name']);
        }

        return $email;
    }
}
