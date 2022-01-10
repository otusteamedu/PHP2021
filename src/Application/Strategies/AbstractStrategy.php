<?php


namespace App\Application\Strategies;


use App\Infrastructure\Factories\ProductFactoryInterface;

abstract class AbstractStrategy implements Strategy
{
    protected $factory;

    public function __construct(ProductFactoryInterface $productFactory)
    {
        $this->factory = $productFactory;
    }

}