<?php
namespace App\Decorator;

require_once "../Interfaces/FactoryInterface";

abstract class ProductDecorator implements Food {

    protected $decoratedProduct;

    public function __construct(Food $decoratedProduct){

        $this->decoratedProduct = $decoratedProduct;

    }

    public function getProduct(){
        return $this->decoratedProduct->getProduct();
    }

}


