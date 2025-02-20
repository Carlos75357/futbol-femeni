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
    public $timestamp;

    public function __construct($partit)
    {
        $this->partit = $partit;
        $this->timestamp = now()->timestamp;
    }

    public function broadcastWith()
    {
        return [
            'partit' => $this->partit,
            'timestamp' => $this->timestamp,
        ];
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