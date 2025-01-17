<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeliveryRequestUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $deliveryRequest;
    public $driverId;

    // Constructor accepts both the deliveryRequest and driverId
    public function __construct($deliveryRequest, $driverId)
    {
        $this->deliveryRequest = $deliveryRequest;
        $this->driverId = $driverId;
    }

    // Broadcast on a channel specific to the driver
    public function broadcastOn()
    {
        return new Channel('driver.' . $this->driverId); // Channel is based on the driver_id
    }

    // Broadcast the necessary data with the event
    public function broadcastWith()
    {
        return [
            'delivery_request' => $this->deliveryRequest
        ];
    }
}
