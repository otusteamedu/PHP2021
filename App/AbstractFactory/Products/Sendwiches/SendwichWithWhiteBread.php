<?php

namespace App\AbstractFactory\Products\Sendwiches;

require_once "../../Interfaces/FactoryInterface";

class SendwichWithWhiteBread implements Food{
    
    private $productName;

    public function __construct(String $productName){
        $this->productName = $productName;
    }

    public function getProduct()
    {
        return "Сендвич с белым хлебом {$productName}";
    }

}