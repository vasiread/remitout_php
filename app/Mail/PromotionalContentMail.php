<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PromotionalContentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $content;  // Make sure this is properly passed from the controller

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.promotional')  // Your view file
            ->with([
                'content' => $this->content,  // Pass the dynamic content here
            ])
            ->subject('Promotional Content Mail');  // Add subject here instead of using envelope method
    }

    /**
     * Get the attachments for the message (if any).
     *
     * @return array
     */
    public function attachments()
    {
        return [];  // Add attachments logic if needed
    }
}
