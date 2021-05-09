<?php

namespace App\Transformers\Responses;

use App\Constants;
use App\Logger\Logger;
use App\Transformers\TransformerInterface;

/**
 * Class TrivagoResponseTransformer
 *
 * @package App\Transformers\Responses
 */
class TrivagoResponseTransformer implements TransformerInterface
{
    public function transform($data): array
    {
        $status = $data->state ?? null;
        if ($status == Constants::FALSE_RESPONSE) {
            $logger = new Logger();
            $logger->warning(Constants::FALSE_RESPONSE);
        }

        return ['status' => $status == Constants::OK ? Constants::TRUE_RESPONSE : Constants::FALSE_RESPONSE];
    }
}