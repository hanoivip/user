<?php

namespace Hanoivip\User\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $token;
    
    protected $expires;
    
    public function __construct($token, $expires = null)
    {
        $this->token = $token;
        if (empty($expires))
        {
            $now = Carbon::now();
            $this->expires = $now->addSecond(config('id.email.expires'));
        }
        else
            $this->expires = $expires;
    }

    public function build()
    {
        return $this->view('hanoivip::emails.secure-reset-password',
            ['token' => $this->token, 'expires' => $this->expires]);
    }
}
