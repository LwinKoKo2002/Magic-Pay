<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class GeneralNotification extends Notification
{
    use Queueable;

    protected $title;
    protected $message;
    protected $sourceable_id;
    protected $sourceable_type;
    protected $web_link;
    public function __construct($title, $message, $sourceable_id, $sourceable_type, $web_link)
    {
        $this->title = $title;
        $this->message = $message;
        $this->sourceable_id = $sourceable_id;
        $this->sourceable_type = $sourceable_type;
        $this->web_link = $web_link;
    }

    public function via($notifiable)
    {
        return ['database'];
    }


    public function toDatabase($notifiable)
    {
        return [
            'title'=>$this->title,
            'message'=>$this->message,
            'sourceable_id'=>$this->sourceable_id,
            'sourceable_type'=>$this->sourceable_type,
            'web_link'=>$this->web_link
        ];
    }
}
