<?php

namespace App\Factories;

use App\Constants;
use App\Models\Booking;
use App\Observers\FireBookingToTrivago;

/**
 * Class BookingHandlerNotifyFactory
 *
 * @package App\Factories
 */
class BookingHandlerNotifyFactory
{
    /**
     * @param Booking $booking
     */
    public static function handler(Booking $booking): void
    {
        if ($booking->getReferralProvider() == Constants::TRIVAGO) {
            $booking->attach(new FireBookingToTrivago());
            $booking->notify();
        }
    }
}