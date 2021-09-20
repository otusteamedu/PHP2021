<?php

class FoodObserver implements ObserverInterface
{
    private Product $concreteProduct;

    public function __construct(Product $food ){
        $this->concreteProduct = $food;

    }
    public function handle(Observable $object)
    {
        $this->concreteProduct->setStatus('Продукт готото');
    }

}