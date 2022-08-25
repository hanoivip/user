<?php

namespace Hanoivip\User\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TwofaRevokeDevices extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->view('hanoivip::emails.twofa-revoke-devices', []);
    }
}
