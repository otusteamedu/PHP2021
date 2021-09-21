<?php

class FoodObserver implements ObserverInterface
{
    private Product $concreteProduct;

    public function __construct(BaseProduct $food ){
        $this->concreteProduct = $food;

    }
    public function handle(Observable $object)
    {
        $this->concreteProduct->setStatus('Продукт готот');
    }

}