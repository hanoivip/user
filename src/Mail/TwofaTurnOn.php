<?php

namespace Hanoivip\User\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TwofaTurnOn extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->view('hanoivip::emails.twofa-turnon', []);
    }
}
