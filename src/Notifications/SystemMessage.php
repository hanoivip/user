<?php

namespace Hanoivip\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SystemMessage extends Notification implements ShouldQueue
{
    use Queueable;
    
    private $message;
    
    public function __construct($message)
    {
        $this->message = $message;
    }
    
    public function via($notifiable)
    {
        return ['database'];
    }
    
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->line('The introduction to the notification.')
        ->action('Notification Action', url('/'))
        ->line('Thank you for using our application!');
    }
    
    public function toArray($notifiable)
    {
        return [
            'message'=>$this->message
        ];
    }
}
