<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewScreeningNotification extends Notification
{
    use Queueable;

    public $screening;

    public function __construct($screening)
    {
        $this->screening = $screening;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'screening_id' => $this->screening->id,
            'message' => $this->screening->full_name . ' Membuat antrain screening',
            'full_name' => $this->screening->full_name,
        ];
    }
}

