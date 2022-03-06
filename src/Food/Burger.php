<?php

namespace App\Food;

use App\Proxy\CookProcessInterface;

class Burger extends BaseFood
{
    public function __clone()
    {
        $this->ingredients = ['buns', 'beef'];
        $this->status = CookProcessInterface::STATUS_RAW;
    }
}
