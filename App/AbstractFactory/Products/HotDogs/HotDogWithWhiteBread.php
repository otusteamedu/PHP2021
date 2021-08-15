<?php

namespace App\AbstractFactory\Products\HotDogs;

require_once "../../Interfaces/FactoryInterface";

class HotDogWithBlackBread implements Food{
    
    private $productName;

    public function __construct(String $productName){
        $this->productName = $productName;
    }

    public function getProduct()
    {
        return "Хот-дог с белым хлебом {$productName}";
    }

}