<?php

namespace App\Services;

use App\BookingInterface;

/**
 * Class BookingService
 *
 * @package App\Services
 */
class BookingService
{
    /**
     * @var BookingInterface
     */
    private BookingInterface $booking;

    /**
     * BookingService constructor.
     *
     * @param BookingInterface $booking
     */
    public function __construct(BookingInterface $booking)
    {
        $this->booking = $booking;
    }

    /**
     * @return BookingInterface
     */
    public function create(): BookingInterface
    {
        return $this->booking->save();
    }

    /**
     * @return BookingInterface
     */
    public function cancel(): BookingInterface
    {
        return $this->booking->save();
    }
}