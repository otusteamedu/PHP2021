<?php 
namespace App\Decorator\Features;

use BurgerDecorator;

class OnionDecorator extends BurgerDecorator{
    
    public function __construct(Burger $decoratedBurger){
        parent::__construct($decoratedBurger);
    }

    public function ProductInformation(){
        return parent::ProductInformation()." + Лук";
    }

}