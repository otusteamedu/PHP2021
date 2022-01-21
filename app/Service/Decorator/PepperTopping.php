<?php

namespace App\Service\Decorator;

class PepperTopping extends Decorator
{

    public function getTopping(): string
    {
        return parent::getTopping() .' add Pepper';
    }
}
