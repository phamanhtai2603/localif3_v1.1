<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MyEvent implements ShouldBroadcast
{
  public $message;
  use Dispatchable, InteractsWithSockets, SerializesModels;
  

      /**
     * Create a new event instance.
     *
     * @return void
    */
    
  

  public function __construct($message)
  {
      $this->message = $message;
  }

  public function broadcastOn()
  {
        return new Channel('my-channel');
        // return ['my-channel'];
  }

  public function broadcastAs()
  {
      return 'my-event';
  }
}
