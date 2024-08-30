<?php

namespace App\Notifications;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentNotification extends Notification
{
    use Queueable;

    public $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {

        $profileImageUrl = $this->appointment->user->profile_image_url
            ? asset('storage/' . $this->appointment->user->profile_photo_path)
            : asset('storage/avatar/klinik_gunung_avatar.jpg'); // Gambar default

        return [
            'message' => 'Janji temu baru dengan ' . $this->appointment->user->name,
            'appointment_id' => $this->appointment->id,
            'profile_image' => $profileImageUrl,
        ];
    }
}
