<?php

namespace App\Proxy;

use App\Food\FoodInterface;
use App\Observer\CookObservationServiceInterface;

class CookProcess implements CookProcessInterface
{
    private CookProcessInterface $process;
    private CookObservationServiceInterface $observation;

    public function __construct(
        CookProcessInterface $process,
        CookObservationServiceInterface $observation
    ) {
        $this->process = $process;
        $this->observation = $observation;
    }

    public function cookFood(FoodInterface $food): void
    {
        if ($food->getStatus() === FoodInterface::STATUS_RAW) {
            $this->observation->start();
        }
        $this->process->cookFood($food);
        $this->observation->notify($food->getStatus());
        if ($food->getStatus() === FoodInterface::STATUS_FAIL) {
            $this->cookFood($food);
        }
        if ($food->getStatus() === FoodInterface::STATUS_DONE) {
            $this->observation->stop();
        }
    }
}
