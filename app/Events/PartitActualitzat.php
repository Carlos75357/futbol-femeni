<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PartitActualitzat implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $partit;

    public function __construct($partit)
    {
         $this->partit = $partit;
    }

    public function broadcastOn()
    {
        return new Channel('futbol-femeni');
    }

    public function broadcastAs()
    {
         return 'PartitActualitzat';
    }
}