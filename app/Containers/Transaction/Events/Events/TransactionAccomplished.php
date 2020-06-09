<?php

namespace App\Containers\Transaction\Events\Events;

use App\Ship\Parents\Events\Event;
use Illuminate\Queue\SerializesModels;

/**
 * Class TransactionAccomplished
 */
class TransactionAccomplished extends Event
{
    use SerializesModels;

    /**
     * @var \App\Containers\Transaction\Models\Transaction
     */
    public $entity;

    /**
     * TransactionAccomplished constructor.
     *
     * @param $entity
     */
    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
