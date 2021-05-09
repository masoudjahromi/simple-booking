<?php

namespace App\Models;

use SplSubject;
use Money\Money;
use App\Constants;
use App\HotelInterface;
use App\LocaleInterface;
use App\BookingInterface;
use App\StatusIdInterface;
use App\BookingIdInterface;
use App\AdvertiserIdInterface;
use App\ReferralProviderInterface;
use App\Models\Traits\SplObserverTrait;
use App\Factories\BookingHandlerNotifyFactory;

/**
 * Class Booking
 *
 * @package App\Models
 */
class Booking implements BookingInterface, SplSubject
{
    use SplObserverTrait;

    /**
     * @var BookingIdInterface
     */
    private BookingIdInterface $bookingId;
    /**
     * @var AdvertiserIdInterface
     */
    private AdvertiserIdInterface $advertiserId;
    /**
     * @var HotelInterface
     */
    private HotelInterface $hotel;
    /**
     * @var int
     */
    private int $numberOfRooms;
    /**
     * @var \DateTime
     */
    private \DateTime $bookingDate;
    /**
     * @var \DateTime
     */
    private \DateTime $arrivalDate;
    /**
     * @var \DateTime
     */
    private \DateTime $departureDate;
    /**
     * @var Money
     */
    private Money $currency;
    /**
     * @var LocaleInterface
     */
    private LocaleInterface $locale;
    /**
     * @var ReferralProviderInterface
     */
    private ReferralProviderInterface $referralProvider;
    /**
     * @var StatusIdInterface
     */
    private StatusIdInterface $statusId;

    /**
     * Booking constructor.
     * @param BookingIdInterface        $bookingId
     * @param AdvertiserIdInterface     $advertiserId
     * @param HotelInterface            $hotel
     * @param int                       $numberOfRooms
     * @param \DateTime                 $bookingDate
     * @param \DateTime                 $arrivalDate
     * @param \DateTime                 $departureDate
     * @param Money                     $currency
     * @param LocaleInterface           $locale
     * @param ReferralProviderInterface $referralProvider
     * @param StatusIdInterface         $statusId
     */
    public function __construct(
        BookingIdInterface $bookingId,
        AdvertiserIdInterface $advertiserId,
        HotelInterface $hotel,
        int $numberOfRooms,
        \DateTime $bookingDate,
        \DateTime $arrivalDate,
        \DateTime $departureDate,
        Money $currency,
        LocaleInterface $locale,
        ReferralProviderInterface $referralProvider,
        StatusIdInterface $statusId
    )
    {
        $this->bookingId = $bookingId;
        $this->advertiserId = $advertiserId;
        $this->hotel = $hotel;
        $this->numberOfRooms = $numberOfRooms;
        $this->bookingDate = $bookingDate;
        $this->arrivalDate = $arrivalDate;
        $this->departureDate = $departureDate;
        $this->currency = $currency;
        $this->locale = $locale;
        $this->referralProvider = $referralProvider;
        $this->statusId = $statusId;
    }

    public function get(): BookingInterface
    {
        return $this;
    }

    public function getReference(): BookingIdInterface
    {
        return $this->bookingId;
    }

    public function getAdvertiser(): AdvertiserIdInterface
    {
        return $this->advertiserId;
    }

    public function getHotel(): HotelInterface
    {
        return $this->hotel;
    }

    public function getBookingDate(): \DateTime
    {
        return $this->bookingDate;
    }

    public function getArrivalDate(): \DateTime
    {
        return $this->arrivalDate;
    }

    public function getDepartureDate(): \DateTime
    {
        return $this->departureDate;
    }

    public function getCancellationDate(): \DateTime
    {
        if ($this->getStatus() == Constants::CANCELED) {
            return new \DateTime();
        }
    }

    public function getTotalGross(): float
    {
        return $this->currency->getAmount();
    }

    public function getCurrency(): string
    {
        return $this->currency->getCurrency();
    }

    public function getLocale(): LocaleInterface
    {
        return $this->locale;
    }

    public function getNumberRooms(): int
    {
        return $this->numberOfRooms;
    }

    public function getReferralProvider(): ReferralProviderInterface
    {
        return $this->referralProvider;
    }

    public function getStatus(): StatusIdInterface
    {
        return $this->statusId;
    }

    public function save(): BookingInterface
    {
        BookingHandlerNotifyFactory::handler($this);

        return $this;
    }
}