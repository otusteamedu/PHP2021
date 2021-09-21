<?php

class HotDog implements Product{

    public $cheese;
    public $tomato;
    public $pepper;
    public $salad;

    public function __construct(){
        $this->cheese = parent::isCheese();
        $this->tomato = parent::isTomato();
        $this->pepper = parent::isPepper();
        $this->green = parent::isGreen();
    }

    public function getPrice(): int
    {
        return 300;
    }

    public function getDescription(): string
    {
        return "Tasty hotdog";
    }
}