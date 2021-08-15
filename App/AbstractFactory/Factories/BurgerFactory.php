<?php

namespace App\AbstractFactory\Factories;

use App\AbstractFactory\Products\Burgers\BurgerWithBlackBread;
use App\AbstractFactory\Products\Burgers\BurgerWithWhiteBread;

require_once "../../Interfaces/FactoryInterface";



class BurgerFactory implements ProductFactory{

    private $productName;

    public function __construct($productName){
        $this->productName = $productName;
    }

    /* Бургер с черным хлебом */
    public function createBlackBreadProduct() : BlackBread
    {
        return new BurgerWithBlackBread($this->productName);
    }

    /* Бургер с белым хлебом */
    public function createWhiteBreadProduct() : WhiteBread
    {
        return new BurgerWithWhiteBread($this->productName);
    }

}