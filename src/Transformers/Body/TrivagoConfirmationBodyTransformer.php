<?php

namespace App\Transformers\Body;

use App\Constants;
use App\Models\Booking;
use App\Transformers\TransformerInterface;

/**
 * Class TrivagoConfirmationBodyTransformer
 *
 * @package App\Transformers
 */
class TrivagoConfirmationBodyTransformer implements TransformerInterface
{
    /**
     * @param Booking $data
     *
     * @return array
     */
    public function transform($data): array
    {
        return [
            'trv_reference' => $data->getReference(),
            'advertiser_id' => $data->getAdvertiser(),
            'hotel' => $data->getHotel(),
            'arrival' => $data->getArrivalDate()->getTimestamp(),
            'departure' => $data->getDepartureDate()->getTimestamp(),
            'booking_date' => $data->getBookingDate()->getTimestamp(),
            'date_format' => $data->getBookingDate()->format('Ymd'),
            'booking_date_format' => $data->getBookingDate()->format('YmdHis'),
            'volume' => $data->getTotalGross(),
            'currency' => $data->getCurrency(),
            'booking_id' => $data->getReference(),
            'locale' => $data->getLocale(),
            'number_of_rooms' => $data->getNumberRooms(),
            'channel' => Constants::TEBADV_CHANNEL,
        ];
    }
}