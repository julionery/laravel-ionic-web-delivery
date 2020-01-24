<?php

namespace WebDelivery\Events;

use WebDelivery\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use WebDelivery\Models\Geo;
use WebDelivery\Models\Pedido;

class GetLocationEntregador extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $geo;

    private $model;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Geo $geo, Pedido $pedido)
    {
        $this->geo = $geo;
        $this->model = $pedido;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [$this->model->hash];
    }
}
