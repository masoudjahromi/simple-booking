<?php


namespace App\Models\Traits;

use SplObserver;

/**
 * Trait SplObserverTrait
 *
 * @package App\Models
 */
trait SplObserverTrait
{

    /**
     * Array of the observers
     *
     * @var array
     */
    protected array $observers = [];

    public function attach(SplObserver $observer)
    {
        $key = spl_object_hash($observer);
        $this->observers[$key] = $observer;

        return $this;
    }

    public function detach(SplObserver $observer)
    {
        $key = spl_object_hash($observer);
        unset($this->observers[$key]);
    }

    public function notify()
    {
        /** @var SplObserver $observer */
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function getObservers(): array
    {
        return $this->observers;
    }

}