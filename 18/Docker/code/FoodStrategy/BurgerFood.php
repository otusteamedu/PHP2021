<?php

class BurgerFood implements SelectFoodInterface
{
    private $factory;

    function __construct($factory){
        $this->factory = new FactoryBurger();
    }
    public function makeFood()
    {
        $this->factory->createProduct();
    }

}