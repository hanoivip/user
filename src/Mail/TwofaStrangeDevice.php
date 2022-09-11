<?php

namespace Hanoivip\User\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TwofaStrangeDevice extends Mailable
{
    use Queueable, SerializesModels;
    
    public $deviceIp;
    
    public $deviceName;

    public function __construct($name, $ip)
    {
        $this->deviceIp = $ip;
        $this->deviceName = $name;
    }

    public function build()
    {
        return $this->view('hanoivip::emails.twofa-strange-device',
            ['ip' => $this->deviceIp, 'name' => $this->deviceName]);
    }
}
