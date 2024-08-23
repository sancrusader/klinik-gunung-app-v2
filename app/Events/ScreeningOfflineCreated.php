<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use App\Models\ScreeningOffline;

class ScreeningOfflineCreated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $screeningOffline;

    public function __construct(ScreeningOffline $screeningOffline)
    {
        $this->screeningOffline = $screeningOffline;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('paramedis');
    }

    public function broadcastAs()
    {
        return 'screening.offline.created';
    }
}
