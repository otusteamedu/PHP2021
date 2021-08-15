<?php 

namespace App\AbstractFactory\Products\Burgers;

require_once "../../Interfaces/FactoryInterface";

class BurgerWithBlackBread implements Food{

    private $productName;

    public function __construct(String $productName){
        $this->productName = $productName;
    }

    public function getProduct()
    {
        return "Гамбургер с белым хлебом {$productName}";
    }

}