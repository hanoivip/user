<?php

namespace Hanoivip\User\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserGift extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $target;
    
    protected $giftcode;
    
    protected $template;

    public function __construct($target, $giftcode, $template)
    {
        $this->target = $target;
        $this->giftcode = $giftcode;
        $this->template = $template;
    }

    public function build()
    {
        return $this->to($this->target)
            ->subject('BQT Ngoạ Long VN1 thân tặng bạn giftcode')
            ->view($this->template, ['giftcode' => $this->giftcode]);
    }
}
