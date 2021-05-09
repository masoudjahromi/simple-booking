<?php


namespace App\tests;


use App\Models\BookingId;
use PHPUnit\Framework\TestCase;

/**
 * Class BookingIdTest
 *
 * @package App\tests
 */
class BookingIdTest extends TestCase
{
    public function test_it_should_be_create_booking_id()
    {
        $bookingId = new BookingId(Constants::BOOKING_ID);

        $this->assertEquals(Constants::BOOKING_ID, $bookingId);
    }
}