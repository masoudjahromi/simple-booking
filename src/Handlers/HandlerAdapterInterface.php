<?php

namespace App\Handlers;

use App\Models\Booking;

/**
 * Interface HandlerAdapterInterface
 *
 * @package App\Handlers
 */
interface HandlerAdapterInterface
{
    function confirmation(Booking $booking): array;

    function cancellation(Booking $booking): array;
}