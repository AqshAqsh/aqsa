<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;

class NoticeNotification extends Notification
{
    use Queueable;

    protected $notice;

    public function __construct($notice)
    {
        $this->notice = $notice;
    }

    public function via($notifiable)
    {
        // If you still want to notify users, you can leave it like this:
        return ['database'];  // But you'll need to manually dispatch the notification elsewhere
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->notice->title,
            'content' => $this->notice->content,
            'expiry_date' => $this->notice->expiry_date,
            'created_at' => $this->notice->date,
        ];
    }
}
