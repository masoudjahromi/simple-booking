<?php

namespace App\tests;

use DateTime;
use Money\Money;
use App\Models\Hotel;
use App\Models\Booking;
use App\Models\LocaleId;
use App\Models\StatusId;
use App\BookingInterface;
use App\Models\BookingId;
use App\Models\AdvertiserId;
use PHPUnit\Framework\TestCase;
use App\Models\ReferralProviderId;
use App\Constants as AppConstants;
use App\tests\Constants as TestConstants;

/**
 * Class BookingTest
 *
 * @package App\tests
 */
class BookingTest extends TestCase
{

    public function test_it_should_be_possible_to_create_a_booking()
    {
        $booking = BookingTest::do_create_booking_object(
            TestConstants::BOOKING_ID,
            TestConstants::ADVERTISER_ID,
            AppConstants::TRIVAGO,
            AppConstants::CREATED
        );

        $this->assertEquals(TestConstants::BOOKING_ID, $booking->getReference());
        $this->assertEquals(TestConstants::ADVERTISER_ID, $booking->getAdvertiser());
        $this->assertEquals(AppConstants::CREATED, $booking->getStatus());
        $this->assertInstanceOf(BookingInterface::class, $booking->get());
    }

    public static function do_create_booking_object($bookingId, $advertiserId, $referralProvider, $status): Booking
    {
        $bookingId = new BookingId($bookingId);
        $advertiserId = new AdvertiserId($advertiserId);
        $hotel = new Hotel(TestConstants::HOTEL_NAME);
        $numberOfRooms = 2;
        $bookingDate = new DateTime();
        $arrivalDate = new DateTime('2021-06-05');
        $departureDate = new DateTime('2021-06-10');
        $currency = Money::EUR(TestConstants::SAMPLE_PRICE);
        $locale = new LocaleId(TestConstants::LocaleId);
        $referralProvider = new ReferralProviderId($referralProvider);
        $status = new StatusId($status);

        return new Booking(
            $bookingId,
            $advertiserId,
            $hotel,
            $numberOfRooms,
            $bookingDate,
            $arrivalDate,
            $departureDate,
            $currency,
            $locale,
            $referralProvider,
            $status
        );
    }
}