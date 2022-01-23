<?php

namespace App\Service\Strategy;



class Food
{
    private $strategy;

    public function __construct(StrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    public function execute()
    {
        return $this->strategy->execute();
    }
}
