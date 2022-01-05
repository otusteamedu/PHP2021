<?php


namespace App;


class App
{
    private $productFactory;

    public function __constructor(ProductFactoryInterface $productFactory)
    {
        $this->productFactory = $productFactory;
    }

    public function initialize()
    {
        $product = $this->productFactory->createProduct();
    }
}