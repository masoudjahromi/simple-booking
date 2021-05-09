<?php

require __DIR__ . '/vendor/autoload.php';

$bookingId = new \App\Models\BookingId('f69cf86d-e01b-428b-aadd-cefde5ed428b');
$advertiserId = new \App\Models\AdvertiserId('4eeb');
$hotel = new \App\Models\Hotel('Carlton Square');
$numberOfRooms = 2;
$bookingDate = new DateTime();
$arrivalDate = new DateTime('2021-06-05');
$departureDate = new DateTime('2021-06-10');
$currency = \Money\Money::EUR(410);
$locale = new \App\Models\LocaleId('NL');
$referralProvider = new \App\Models\ReferralProviderId('Trivago');
$status = new \App\Models\StatusId('created');

/**
 * Confirmation flow
 */
$booking = new \App\Models\Booking(
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
$bookingService = new \App\Services\BookingService($booking);
$bookingService->create();

/**
 * cancellation flow
 */
$status = new \App\Models\StatusId('cancelled');
$booking = new \App\Models\Booking(
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
$bookingService = new \App\Services\BookingService($booking);
$bookingService->cancel();
