<?php

namespace App\Application\Strategies;

use App\Application\ProductFactoryInterface;

abstract class AbstractStrategy implements Strategy
{
    protected $factory;

    public function __construct(ProductFactoryInterface $productFactory)
    {
        $this->factory = $productFactory;
    }

}