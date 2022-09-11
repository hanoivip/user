<?php

namespace Hanoivip\User\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TwofaRevokeDevice extends Mailable
{
    use Queueable, SerializesModels;
    
    public $device;

    public function __construct()
    {
    }

    public function build()
    {
        return $this->view('hanoivip::emails.twofa-revoke-device', []);
    }
}
