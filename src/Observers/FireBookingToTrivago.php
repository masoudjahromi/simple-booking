<?php

namespace App\Observers;

use SplSubject;
use SplObserver;
use GuzzleHttp\Client;
use App\Models\Booking;
use App\Handlers\Trivago\Trivago;
use App\Handlers\Trivago\TrivagoHandlerAdapter;

/**
 * Class FireBookingToTrivago
 *
 * @package App\Observers
 */
class FireBookingToTrivago implements SplObserver
{

    private $result;

    public function __construct()
    {
        $this->result = null;
    }

    /**
     * @param Booking $booking
     */
    public function update(SplSubject $booking)
    {
        $trivagoAdapter = new TrivagoHandlerAdapter(new Trivago(new Client()));
        if ($booking->getStatus() == 'created') {
            $this->result = $trivagoAdapter->confirmation($booking);
        }
        if ($booking->getStatus() == 'cancelled') {
            $this->result = $trivagoAdapter->cancellation($booking);
        }
    }

    public function getResult()
    {
        return $this->result;
    }
}