<?php

namespace App\Strategy;

use App\Strategy\Interface\Strategy;

class FinishedProduct
{
    private $strategy;

    public function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function execute(int $standard): string
    {
        return $this->strategy->execute($standard);
    }
}