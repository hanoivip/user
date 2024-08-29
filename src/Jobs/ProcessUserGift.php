<?php

namespace Hanoivip\User\Jobs;

use Hanoivip\CurlHelper;
use Hanoivip\User\Mail\UserGift;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Exception;

class ProcessUserGift implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $giftcode;
    
    protected $gserver;
    
    protected $receiver;
    
    protected $package;
    
    protected $mailTemplate;

    /**
     * 
     * @param string $gserver Uri of gift server. Ex: http://play.ngoalong.vn1.us/
     * @param string $receiver Email of receiver/user
     * @param string $package Gift package/template name
     * @param string $mailTemplate Name of view/email template
     */
    public function __construct(
        $gserver,
        $receiver,
        $package,
        $mailTemplate)
    {
        $this->gserver = $gserver;
        $this->receiver = $receiver;
        $this->package = $package;
        $this->mailTemplate = $mailTemplate;
    }

    public function handle()
    {
        // 1. Generate giftcode
        if (empty($this->giftcode))
        {
            $url = $this->gserver . '/sys/gift/generate';
            $response = CurlHelper::factory($url)
            ->setPostFields([
                'package' => $this->package,
                'target' => $this->receiver,
            ])
            ->exec();
            if ($response['status'] != 200)
            {
                $this->fail('Gift server error!');
                return;
            }
            $this->giftcode = $response['content'];
        }
        // 2. Send email
        try 
        {
            Mail::send(new UserGift($this->receiver, $this->giftcode, $this->mailTemplate));
        }
        catch (Exception $ex)
        {
            $this->fail('Send mail error. Msg:' . $ex->getMessage());
            return;
        }
    }
}
