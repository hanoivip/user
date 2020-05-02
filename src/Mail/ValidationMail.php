<?php

namespace Hanoivip\User\Mail;

use Hanoivip\User\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ValidationMail extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $token;
    
    protected $user;
    
    protected $expires;

    /**
     * 
     * @param User $user
     * @param string $token
     * @param Carbon $expires
     */
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

    /**
     * Build the message.
     *
     */
    public function build()
    {
        return $this->to($this->user->email)
                    ->view('emails.update-login', 
                        ['username' => $this->user->name, 'token' => $this->token, 'expires' => $this->expires]);
    }
}
