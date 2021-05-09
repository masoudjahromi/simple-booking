<?php

namespace App\tests;

use PHPUnit\Framework\TestCase;
use App\Services\BookingService;
use App\Constants as AppConstants;
use App\tests\Constants as TestConstants;

/**
 * Class BookingServiceTest
 *
 * @package App\tests
 */
class BookingServiceTest extends TestCase
{
    public function test_it_should_be_create_booking_with_trivago_provider()
    {
        $booking = BookingTest::do_create_booking_object(
            TestConstants::BOOKING_ID,
            TestConstants::ADVERTISER_ID,
            AppConstants::TRIVAGO,
            AppConstants::CREATED
        );
        $bookingService = new BookingService($booking);
        $result = $bookingService->create();

        $observers = $result->getObservers();

        $this->assertCount(1, $observers);
        $this->assertEquals(AppConstants::TRUE_RESPONSE, collect($observers)->first()->getResult()['status']);
    }

    public function test_it_should_be_cancel_booking_with_trivago_provider()
    {
        $booking = BookingTest::do_create_booking_object(
            TestConstants::BOOKING_ID,
            TestConstants::ADVERTISER_ID,
            AppConstants::TRIVAGO,
            AppConstants::CANCELED
        );
        $bookingService = new BookingService($booking);
        $result = $bookingService->cancel();

        $observers = $result->getObservers();

        $this->assertCount(1, $observers);
        $this->assertEquals(AppConstants::TRUE_RESPONSE, collect($observers)->first()->getResult()['status']);
    }

    public function test_it_should_be_create_booking_with_expedia_provider()
    {
        $booking = BookingTest::do_create_booking_object(
            TestConstants::BOOKING_ID,
            TestConstants::ADVERTISER_ID,
            AppConstants::EXPEDIA,
            AppConstants::CREATED
        );
        $bookingService = new BookingService($booking);
        $result = $bookingService->create();
        $observers = $result->getObservers();

        $this->assertEmpty($observers);
    }

    public function test_it_should_be_cancel_booking_with_expedia_provider()
    {
        $booking = BookingTest::do_create_booking_object(
            TestConstants::BOOKING_ID,
            TestConstants::ADVERTISER_ID,
            AppConstants::EXPEDIA,
            AppConstants::CANCELED
        );
        $bookingService = new BookingService($booking);
        $result = $bookingService->create();
        $observers = $result->getObservers();

        $this->assertEmpty($observers);
    }
}