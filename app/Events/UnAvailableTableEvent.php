<?php

namespace App\Events;

use App\Models\Table;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UnAvailableTableEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $customerData;
    /**
     * @var Table
     */
    public $table;
    public $from;
    public $to;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($customerData, Table $table, $from, $to)
    {
        $this->customerData = $customerData;
        $this->table        = $table;
        $this->from         = $from;
        $this->to           = $to;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
