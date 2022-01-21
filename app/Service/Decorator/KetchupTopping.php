<?php

namespace App\Service\Decorator;

class KetchupTopping extends Decorator
{

    public function getTopping(): string
    {
        return parent::getTopping() . ' add Ketchup';
    }
}
