<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $otp_code;
    public $fullname;

    /**
     * Create a new message instance.
     *
     * @param string $email
     * @param string $otp_code
     * @param string $fullname
     */
    public function __construct($email, $otp_code, $fullname)
    {
        $this->email = $email;
        $this->otp_code = $otp_code;
        $this->fullname = $fullname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome to Our Platform')
                    ->view('emails.welcome');
    }
}
