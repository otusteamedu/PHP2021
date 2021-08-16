<?php
namespace App\AbstractFactory\Products;

class BlackBreadSendwich implements Sendwich {
    
    private $weight;

    public function __construct(Integer $weight){
        $this->weight = $weight;
    }

    public function ProductInformation() : String {
        return "Сендвич из черного хлеба";
    }
    
}