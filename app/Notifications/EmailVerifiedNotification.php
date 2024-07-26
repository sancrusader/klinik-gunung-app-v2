<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class EmailVerifiedNotification extends Notification
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Email pengguna ' . $this->user->name . ' telah berhasil diverifikasi!',
            'url' => url('/admin/users/' . $this->user->id)
        ];
    }
}
