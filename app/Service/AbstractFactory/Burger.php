<?php

namespace App\Service\AbstractFactory;

class Burger implements BurgerInterface, ToppingInterface
{

    public function getTopping(): string
    {
        return 'Burger ';
    }

}
