<?php

class FactorySandwitch
{
    public function createProduct(): BaseProduct
    {
        return new HotDog();
    }
}