<?php


namespace App;


class App
{
    private $productFactory;
    private $productStrategy;

    public function __constructor(ProductFactoryInterface $productFactory, $productName)
    {
        $this->productFactory = $productFactory;
//        if ($productName == 'burger') {
        $this->setStrategy(new BurgerStrategy());
//        }
    }

    public function initialize()
    {
        $product = $this->productFactory->createProduct();
        $this->productStrategy->execute();
    }

    public function setStrategy(Strategy $strategy)
    {
        $this->productStrategy = $strategy;
    }
}