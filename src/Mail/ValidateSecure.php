<?php

namespace Hanoivip\User\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ValidateSecure extends Mailable
{
    use Queueable, SerializesModels;

    protected $token;
    
    protected $user;
    
    protected $expires;
    
    public function __construct($user, $token, $expires = null)
    {
        $this->user = $user;
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
        //Log::debug('secure email ' . print_r($this->user, true) . ' token:' . $this->token);
        return $this->view('hanoivip::emails.secure-update-email',
            ['username' => $this->user->name, 'token' => $this->token, 'expires' => $this->expires]);
    }
}
