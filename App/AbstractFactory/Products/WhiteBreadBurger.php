<?php
namespace App\AbstractFactory\Products;

class WhiteBreadBurger implements Burger {
    
    private $weight;

    public function __construct(Integer $weight){
        $this->weight = $weight;
    }

    public function ProductInformation() : String {
        return "Бургер из белого хлеба";
    }

}