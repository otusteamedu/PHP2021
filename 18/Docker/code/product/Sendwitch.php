<?php

class Sendwitch implements Product
{
    public bool $tomato;
    public bool $topping;
    public bool $salad;


    public function getPrice(): int
    {
        return 350;
    }

    public function getDescription(): string
    {
        return "Tasty sendwitch";
    }
}