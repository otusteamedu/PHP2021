<?php


namespace App;


abstract class AbstractStrategy implements Strategy
{
    protected $factory;

    public function __construct(ProductFactoryInterface $productFactory)
    {
        $this->factory = $productFactory;
    }
}