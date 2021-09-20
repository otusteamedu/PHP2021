<?php

class HotDog implements Product{


    public bool $cheese;
    public bool $onion;
    public bool $salad;

    public function getPrice(): int
    {
        return 300;
    }

    public function getDescription(): string
    {
        return "Tasty hotdog";
    }
}