<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NextStep
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $user_id;
    public $unit_id;
    public $module_id; 
    /**
     * Create a new event instance.
     */
    public function __construct($user_id, $unit_id, $module_id)
    {
        $this->user_id = $user_id;
        $this->unit_id = $unit_id;
        $this->module_id = $module_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
