<?php

namespace App\Abstracts;

/**
 * Class AbstractId
 *
 * @package App\Abstracts
 */
abstract class AbstractId implements \Stringable
{
    protected string $id;

    /**
     * AbstractId constructor.
     *
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->id;
    }
}