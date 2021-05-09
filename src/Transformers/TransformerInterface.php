<?php

namespace App\Transformers;

/**
 * Interface TransformerInterface
 */
interface TransformerInterface
{
    public function transform($data): array;
}