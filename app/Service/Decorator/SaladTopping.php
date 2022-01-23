<?php

namespace App\Service\Decorator;

class SaladTopping extends Decorator
{

    public function getTopping(): string
    {
        return parent::getTopping() .' add Salad';
    }
}
