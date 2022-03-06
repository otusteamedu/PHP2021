<?php

namespace App\Proxy;

use App\Observer\CookObservation;

class CookProcess implements CookProcessInterface
{
    private CookProcessInterface $food;
    private CookObservation $observation;

    public function __construct(
        CookProcessInterface $food,
        CookObservation $observation
    ) {
        $this->food = $food;
        $this->observation = $observation;
    }

    public function cook(): void
    {
        $this->food->cook();
        $this->observation->notifyByStatus($this->getStatus());
        if ($this->getStatus() === CookProcessInterface::STATUS_FAIL) {
            $this->cook();
        }
    }

    public function getStatus(): int
    {
        return $this->food->getStatus();
    }
}
