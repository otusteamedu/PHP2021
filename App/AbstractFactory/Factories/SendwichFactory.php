<?php

namespace App\AbstractFactory\Factories;

use App\AbstractFactory\Products\Sendwiches\SendwichWithBlackBread;
use App\AbstractFactory\Products\Sendwiches\SendwichWithWhiteBread;

require_once "../../Interfaces/FactoryInterface";

class SendwichFactory implements ProductFactory{

    private $productName;

    public function __construct($productName){
        $this->productName = $productName;
    }

    /* Сендвич с черным хлебом */
    public function createBlackBreadProduct() : BlackBread
    {
        return new SendwichWithBlackBread($this->productName);
    }

    /* Сендвич с белым хлебом */
    public function createWhiteBreadProduct() : WhiteBread
    {
        return new SendwichWithWhiteBread($this->productName);
    }

}