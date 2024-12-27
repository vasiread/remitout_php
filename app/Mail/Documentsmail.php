<?php 
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class DocumentsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $msg;
    public $subject;
    public $attachments; // To hold the URLs or paths of the documents

    /**
     * Create a new message instance.
     *
     * @param string $msg
     * @param string $subject
     * @param string $folderPath
     * @return void
     */
    public function __construct($msg, $subject, $folderPath)
    {
        $this->msg = $msg;
        $this->subject = $subject;
        $this->attachments = $this->getDocuments($folderPath); // Get all documents from the folder
    }

    /**
     * Get all files from the S3 folder and prepare them for email attachments.
     *
     * @param string $folderPath
     * @return array
     */
    private function getDocuments($folderPath)
    {
        // Get all files in the folder
        $files = Storage::disk('s3')->allFiles($folderPath);
        
        $attachments = [];

        // Loop through all files and prepare them for email attachment
        foreach ($files as $file) {
            // You can either attach by URL or directly attach the file content
            // Here, I'm attaching directly from S3 storage
            $fileContent = Storage::disk('s3')->get($file);  // Get the content of the file
            $fileName = basename($file);  // Get the file name

            $attachments[] = [
                'file_content' => $fileContent,
                'file_name' => $fileName,
            ];
        }

        return $attachments;
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
            view: 'emails.documents',  // Your email view
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        // Prepare the attachments from the S3 folder
        return $this->attachments;
    }

    /**
     * Build the email message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->view('emails.documents')  // Your email view
            ->subject($this->subject)
            ->with('msg', $this->msg);

        // Attach each file retrieved from S3
        foreach ($this->attachments as $attachment) {
            $email->attachData($attachment['file_content'], $attachment['file_name']);
        }

        return $email;
    }
}
