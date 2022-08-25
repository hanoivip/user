<?php

namespace Hanoivip\User\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TwofaValueRemoved extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $way;
    
    protected $value;
    
    public function __construct($way, $value)
    {
        $this->way = $way;
        $this->value = $value;
    }
    
    public function build()
    {
        return $this->view('hanoivip::emails.twofa-value-removed',
            ['way' => $this->way, 'value' => $this->value]);
    }
}
