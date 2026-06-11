<?php


namespace App\Events;

use App\Models\SensorData;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SensorUpdated implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public $sensor;

    public function __construct(SensorData $sensor)
    {
        $this->sensor = $sensor;
    }

    public function broadcastOn()
    {
        return new Channel('sensor');
    }

    public function broadcastAs()
    {
        return 'sensor.updated';
    }
}
