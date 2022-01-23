<?php

namespace App\Service\AbstractFactory;

class HotDog implements HotDogInterface, ToppingInterface
{


    public function getTopping(): string
    {
        return 'HotDog ';
    }
}
