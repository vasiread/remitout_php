<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendDocumentsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $filePaths;
    public $email;
    public $name;
    public $userId;

    public function __construct($filePaths, $email, $name,$userId)
    {
        $this->filePaths = $filePaths;
        $this->email = $email;
        $this->name = $name;
        $this->userId = $userId;


    }

    public function build()
    {
         $documentNames = array_map(function ($filePath) {
            return basename($filePath);  
        }, $this->filePaths);

         $subject = 'Documents Shared: ' . implode(', ', $documentNames);

         $mail = $this->subject($subject)
            ->view('email.email', ['documentNames' => $documentNames]);

         foreach ($this->filePaths as $filePath) {
            $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
            if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                $mail->attachFromStorageDisk('s3', $filePath, basename($filePath));  
            } elseif ($fileExtension == 'pdf') {
                $mail->attachFromStorageDisk('s3', $filePath, basename($filePath));   
            }
        }

        return $mail;
    }
    
}
