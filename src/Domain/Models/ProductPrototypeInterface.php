<?php


namespace App\Domain\Models;


interface ProductPrototypeInterface
{
    public function __construct(BaseProduct $prototype = null);

    public function getName(): string;

    public function clone(): ProductPrototypeInterface;
}