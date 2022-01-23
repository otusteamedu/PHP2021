<?php

namespace App\Service\Decorator;

class MustardTopping extends Decorator
{

    public function getTopping(): string
    {
        return parent::getTopping() . ' add Mustard';
    }
}
