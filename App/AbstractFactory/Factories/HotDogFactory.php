<?php

namespace App\AbstractFactory\Factories;

use App\AbstractFactory\Products\HotDogs\HotDogWithBlackBread;
use App\AbstractFactory\Products\HotDogs\HotDogWithWhiteBread;

require_once "../../Interfaces/FactoryInterface";

class HotDogFactory implements ProductFactory{

    private $productName;

    public function __construct($productName){
        $this->productName = $productName;
    }

    /* Хот-дог с черным хлебом */
    public function createBlackBreadProduct() : BlackBread
    {
        return new HotDogWithBlackBread($this->productName);
    }

    /* Хот-дог с белым хлебом */
    public function createWhiteBreadProduct() : WhiteBread
    {
        return new HotDogWithWhiteBread($this->productName);
    }

}