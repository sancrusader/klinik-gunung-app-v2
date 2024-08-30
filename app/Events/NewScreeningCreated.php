<?php

namespace App\Events;

use App\Models\ScreeningOffline;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewScreeningCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $screening;

    public function __construct($screening)
    {
        $this->screening = $screening;
    }

    public function broadcastOn()
    {
        return [
            new Channel('screenings'),
        ];
    }
}
