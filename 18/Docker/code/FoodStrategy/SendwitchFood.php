<?php

class SendwitchFood implements SelectFoodInterface
{
    private $factory;

    function __construct($factory){
        $this->factory = new FactorySandwitch();
    }
    public function makeFood()
    {
        $this->factory->createProduct();
    }

}