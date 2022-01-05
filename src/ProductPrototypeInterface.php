<?php


namespace App;


interface ProductPrototypeInterface
{
    public function clone(): ProductPrototypeInterface;
}