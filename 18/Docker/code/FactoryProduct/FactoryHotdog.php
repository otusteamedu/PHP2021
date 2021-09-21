<?php

class FactoryHotdog implements FactoryProduct
{
    public function createProduct(): BaseProduct
    {
        return new HotDog();
    }
}