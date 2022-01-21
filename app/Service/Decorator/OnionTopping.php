<?php

namespace App\Service\Decorator;

class OnionTopping extends Decorator
{

    public function getTopping(): string
    {
        return parent::getTopping() .' add Onion';
    }
}
