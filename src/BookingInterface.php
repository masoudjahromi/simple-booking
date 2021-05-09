<?php

namespace App;

/**
 * Interface BookingInterface
 *
 * @package App
 */
interface BookingInterface
{
    public function get(): BookingInterface;

    public function getReference(): BookingIdInterface;

    public function getAdvertiser(): AdvertiserIdInterface;

    public function getHotel(): HotelInterface;

    public function getBookingDate(): \DateTime;

    public function getArrivalDate(): \DateTime;

    public function getDepartureDate(): \DateTime;

    public function getCancellationDate(): \DateTime;

    public function getTotalGross(): float;

    public function getCurrency(): string;

    public function getLocale(): LocaleInterface;

    public function getNumberRooms(): int;

    public function getReferralProvider(): ReferralProviderInterface;

    public function getStatus(): StatusIdInterface;

    public function save();

    public function getObservers();
}