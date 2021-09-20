<?php

class FactorySandwitch
{
    public function createProduct(): Product
    {
        return new HotDog();
    }
}