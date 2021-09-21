<?php

class HDFood implements SelectFoodInterface
{
    private $factory;

    function __construct($factory){
        $this->factory = new FactoryHotdog();
    }
    public function makeFood()
    {
        $this->factory->createProduct();
    }
}