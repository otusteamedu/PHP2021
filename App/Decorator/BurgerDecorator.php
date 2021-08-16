<?php
namespace App\Decorator;

require_once "../Interfaces/FactoryInterface";

abstract class BlackBreadBurgerDecorator implements Burger {

    protected $burgerDecorator;

    public function __construct(Burger $burgerDecorator){

        $this->burgerDecorator = $burgerDecorator;

    }

    public function ProductInformation(){
        return $this->burgerDecorator->ProductInformation();
    }

}


