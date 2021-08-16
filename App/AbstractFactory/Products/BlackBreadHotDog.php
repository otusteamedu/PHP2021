<?php
namespace App\AbstractFactory\Products;

class BlackBreadHotDog implements HotDog {
    
    private $weight;

    public function __construct(Integer $weight){
        $this->weight = $weight;
    }

    public function ProductInformation() : String {
        return "Хот-дог из черного хлеба";
    }

}