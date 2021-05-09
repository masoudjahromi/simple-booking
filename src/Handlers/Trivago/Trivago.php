<?php

namespace App\Handlers\Trivago;

use App\Constants;
use GuzzleHttp\Client;
use App\Models\Booking;
use App\Transformers\Responses\TrivagoResponseTransformer;
use App\Transformers\Body\TrivagoCancellationBodyTransformer;
use App\Transformers\Body\TrivagoConfirmationBodyTransformer;

/**
 * Class Trivago
 *
 * @package App\Handlers\Trivago
 */
class Trivago
{
    /**
     * API key for header:X-Trv-Ana-Key
     * @var string
     */
    const API_KEY = 'lorem-ipsum';

    /**
     * Trivago Conversion API endpoint
     * @var string
     */
    const ENDPOINT = 'https://secde.trivago.com/tracking/booking';

    private Client $client;

    /**
     * Trivago constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param Booking $booking
     *
     * @return array
     */
    public function trivagoConfirmation(Booking $booking): array
    {
        $body = (new TrivagoConfirmationBodyTransformer())->transform($booking);

        return $this->sendRequest($body, 'post');
    }

    /**
     * @param Booking $booking
     *
     * @return array
     */
    public function trivagoCancellation(Booking $booking): array
    {
        $body = (new TrivagoCancellationBodyTransformer())->transform($booking);

        return $this->sendRequest($body, 'delete');
    }

    /**
     * @param array  $body
     * @param string $type
     *
     * @return array
     */
    private function sendRequest(array $body, string $type): array
    {
        try {
            $request = $this->client->$type(self::ENDPOINT, [
                [
                    'headers' => [
                        'X-Trv-Ana-Key' => self::API_KEY,
                        'Content-Type'  => 'application/json',
                    ],
                    'body' => json_encode($body),
                ],
            ]);
            $body = json_decode($request->getBody()->getContents(), true);

            return (new TrivagoResponseTransformer())->transform($body);
        } catch (\Exception $exception) {
            return ['status' => Constants::TRUE_RESPONSE];
        }
    }
}