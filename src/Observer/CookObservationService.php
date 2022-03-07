<?php

namespace App\Observer;

class CookObservationService implements CookObservationServiceInterface
{
    private CookObservation $observation;
    private Cook $cook;
    private Customer $customer;

    public function __construct(
        CookObservation $observation,
        Cook $cook,
        Customer $customer
    ) {
        $this->observation = $observation;
        $this->cook = $cook;
        $this->customer = $customer;
    }

    public function start(): void
    {
        $this->observation->attach($this->cook);
        $this->observation->attach($this->customer);
    }

    public function stop(): void
    {
        $this->observation->detach($this->cook);
        $this->observation->detach($this->customer);
    }

    public function notify(int $status)
    {
        $this->observation->notifyByStatus($status);
    }
}
