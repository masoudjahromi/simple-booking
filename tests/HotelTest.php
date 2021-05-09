<?php

namespace App\tests;

use App\Models\Hotel;
use PHPUnit\Framework\TestCase;

/**
 * Class HotelTest
 *
 * @package App\tests
 */
class HotelTest extends TestCase
{
    public function test_it_should_be_create_hotel()
    {
        $hotel = new Hotel(Constants::HOTEL_NAME);

        $this->assertEquals(Constants::HOTEL_NAME, $hotel);
    }
}