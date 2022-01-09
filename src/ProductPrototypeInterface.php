<?php


namespace App;


interface ProductPrototypeInterface
{
    public function __construct(BaseProduct $prototype = null);

    public function clone(): ProductPrototypeInterface;
}