<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class VerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $verificationCode;
    public $user_id;

    public function __construct($user, $verificationCode)
    {
        $this->user = $user;
        $this->user_id =  $user->id;
        $this->verificationCode = $verificationCode;
    }

    public function build()
    {
        return $this->subject('Verify Your Email')->view('emails.verification');
    }
}
