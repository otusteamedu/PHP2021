<?php

class FactoryHotdog implements FactoryProduct
{
    public function createProduct(): Product
    {
        return new HotDog();
    }
}