<?php

namespace App\Events\Device;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendPayloadEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $payload = [];
    public $device;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($device, $payload)
    {
        $this->payload = $payload;
        $this->device = $device;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('App.Device.' . $this->device);
    }

    public function broadcastAs()
    {
        return "send_data_event";
    }

    public function broadcastWith()
    {
        return [
            'device_id' => $this->device,
            'payload' => $this->payload,
            'created_at' => now()
        ];
    }
}
