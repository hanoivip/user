<?php

namespace Hanoivip\User\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserOtp extends Mailable
{
    use Queueable, SerializesModels;
    
    public $otp;
    
    public $expires;

    public function __construct($otp, $expires)
    {
        $this->otp = $otp;
        $this->expires=$expires;
    }

    public function build()
    {
        return $this->view('hanoivip::emails.otp',
            ['otp' => $this->otp, 'expires' => $this->expires]);
    }
}
