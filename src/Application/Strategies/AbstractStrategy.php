<?php

namespace App\Application\Strategies;

use App\Application\ProductFactoryInterface;
use App\Domain\VisitorInterface;

abstract class AbstractStrategy implements Strategy
{
    protected $factory;
    protected $visitor;

    public function __construct(ProductFactoryInterface $productFactory, VisitorInterface $visitor)
    {
        $this->visitor = $visitor;
        $this->factory = $productFactory;
    }

}