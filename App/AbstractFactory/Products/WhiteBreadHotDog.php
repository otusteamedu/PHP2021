<?php
namespace App\AbstractFactory\Products;

class WhiteBreadHotDog implements HotDog {
    
    private $weight;

    public function __construct(Integer $weight){
        $this->weight = $weight;
    }

    public function ProductInformation() : String {
        return "Хот-дог из белого хлеба";
    }

}