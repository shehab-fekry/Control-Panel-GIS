<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class showTrip implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $lng,$lit,$trip_id,$parent_id;

    public function __construct($data)
    {
        $this->lng=$data['lng'];
        $this->lit=$data['lit'];
        $this->trip_id=$data['trip_id'];
        $this->parent_id=$data['parent_id'];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('trip.'.$this->trip_id);
    }
    public function broadcastAs()
    {
        return 'triplocation';
    }

}
