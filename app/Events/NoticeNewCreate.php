<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NoticeNewCreate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;



    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $user;
    public $time;
      public $message;

    public function __construct($user,$time,$mssage)
    {
        $this->user = $user;
        $this->time = $time;
        $this->message = $mssage;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['channel-new'];
       
    }

       public function broadcastAs()
        {
          return 'new_event';
        }
}
