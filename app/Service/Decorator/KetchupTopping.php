<?php

namespace App\Service\Decorator;

class KetchupTopping extends Decorator implements KetchupToppingInterface
{

    public function getTopping(): string
    {
        return parent::getTopping() . ' add Ketchup';
    }
}
