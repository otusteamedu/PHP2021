<?php

namespace App\Observer;

interface CookObservationServiceInterface
{
    public function start(): void;

    public function stop(): void;

    public function notify(int $status);
}
