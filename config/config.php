<?php

use App\Observer\CookObservationService;
use App\Observer\CookObservationServiceInterface;
use App\Proxy\BaseCookProcess;
use App\Proxy\CookProcessInterface;

return [
    CookObservationServiceInterface::class => DI\get(CookObservationService::class),
    CookProcessInterface::class => DI\get(BaseCookProcess::class),
];
