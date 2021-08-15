<?php 
namespace App\Decorator\Features;

use ProductDecorator;

class OnionDecorator extends ProductDecorator{
    
    public function __construct(Food $decoratedProduct){
        parent::__construct($decoratedProduct);
    }

    public function getProduct(){
        return parent::getProduct()." + Лук";
    }

}