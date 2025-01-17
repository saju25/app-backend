<?php
namespace App\Events;

use App\Models\DeliveryManLocation;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DriverLocationUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $location;  // This will be broadcasted to listeners

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(DeliveryManLocation $location)
    {
        $this->location = $location;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('driver-location.' . $this->location->delivery_man_id);  // Unique channel for each delivery man
    }

    /**
     * Get the name of the event.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'DriverLocationUpdated';  // Event name that will be broadcasted
    }
}
