<?php
namespace App\AbstractFactory\Products;

class WhiteBreadSendwich implements Sendwich {
    
    private $weight;

    public function __construct(Integer $weight){
        $this->weight = $weight;
    }

    public function ProductInformation() : String {
        return "Сендвич из белого хлеба";
    }

}