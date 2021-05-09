<?php

namespace App\Handlers\Trivago;


use App\Models\Booking;
use App\Handlers\HandlerAdapterInterface;

/**
 * Class TrivagoHandlerAdapter
 *
 * @package App\Handler\Trivago
 */
class TrivagoHandlerAdapter implements HandlerAdapterInterface
{
    private Trivago $trivago;

    /**
     * TrivagoAdapter constructor.
     * @param Trivago $trivago
     */
    public function __construct(Trivago $trivago)
    {
        $this->trivago = $trivago;
    }

    function confirmation(Booking $booking): array
    {
        return $this->trivago->trivagoConfirmation($booking);
    }

    function cancellation(Booking $booking): array
    {
        return $this->trivago->trivagoCancellation($booking);
    }
}