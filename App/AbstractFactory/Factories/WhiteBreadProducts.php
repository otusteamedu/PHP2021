<?php
namespace App\AbstractFactory\Factories;

use App\AbstractFactory\Products\WhiteBreadBurger;
use App\AbstractFactory\Products\WhiteBreadHotDog;
use App\AbstractFactory\Products\WhiteBreadSendwich;

require_once "../../Interfaces/FactoryInterface.php";


class WhiteBreadProducts implements ProductFactory {
    
    public function createBurger() : Burger {
        return new WhiteBreadBurger();
    }

    public function createSendwich() : Sendwich {
        return new WhiteBreadSendwich();
    }

    public function createHotDog() : HotDog {
        return new WhiteBreadHotDog(); 
    }
}