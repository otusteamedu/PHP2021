<?php

namespace App\Food;

use App\Proxy\CookProcessInterface;

class Sandwich extends BaseFood
{
    public function __clone()
    {
        $this->ingredients = ['bread'];
        $this->status = CookProcessInterface::STATUS_RAW;
    }
}
