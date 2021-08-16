<?php
namespace App\AbstractFactory\Products;
require_once "../../Interfaces/FactoryInterface.php";

class BlackBreadBurger implements Burger {
    
    private $weight;

    public function __construct(Integer $weight){
        $this->weight = $weight;
    }

    public function ProductInformation() : String {
        return "Бургер из черного хлеба";
    }

}