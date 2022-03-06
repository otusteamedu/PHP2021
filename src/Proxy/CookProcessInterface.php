<?php

namespace App\Proxy;

interface CookProcessInterface
{
    public const STATUS_FAIL = -1;
    public const STATUS_RAW = 0;
    public const STATUS_DONE = 1;

    public function cook(): void;

    public function getStatus(): int;
}
