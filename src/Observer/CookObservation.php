<?php

namespace App\Observer;

use SplObjectStorage;
use SplObserver;
use SplSubject;

class CookObservation implements SplSubject
{
    private SplObjectStorage $observers;

    public function __construct(SplObjectStorage $observers)
    {
        $this->observers = $observers;
    }

    public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function notifyByStatus(int $status): void
    {
        foreach ($this->observers as $observer) {
            if (get_class($observer) === Customer::class && $status > 0) {
                $observer->update($this);
            }
            if (get_class($observer) === Cook::class && $status < 0) {
                $observer->update($this);
            }
        }
    }
}
