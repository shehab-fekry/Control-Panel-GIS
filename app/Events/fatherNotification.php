<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class fatherNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $father_id,$message;

    public function __construct($id)
    {
        $this->father_id=$id;
        $this->message='the bus has get closer to your house!get ready';

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('father.'.$this->father_id);
    }
    public function broadcastAs()
    {
        return 'fatherNotify';
    }

}
