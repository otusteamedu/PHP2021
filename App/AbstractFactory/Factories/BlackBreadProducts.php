<?php
namespace App\AbstractFactory\Factories;

use App\AbstractFactory\Products\BlackBreadBurger;
use App\AbstractFactory\Products\BlackBreadHotDog;
use App\AbstractFactory\Products\BlackBreadSendwich;

require_once "../../Interfaces/FactoryInterface.php";


class BlackBreadProducts implements ProductFactory {
    
    public function createBurger() : Burger {
        return new BlackBreadBurger();
    }

    public function createSendwich() : Sendwich {
        return new BlackBreadSendwich();
    }

    public function createHotDog() : HotDog {
        return new BlackBreadHotDog(); 
    }
}