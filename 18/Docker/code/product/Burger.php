<?php

class Burger implements Product
{
    public bool $cheese;
    public bool $onion;
    public bool $salad;

    public function getPrice(): int
    {
        return 500;
    }

    public function getDescription(): string
    {
        return "Tasty burger";
    }

}