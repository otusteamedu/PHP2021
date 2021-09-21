<?php

class FactoryBurger implements FactoryProduct
{
    public function createProduct(): Product
    {
        return new Burger();
    }
}