<?php

namespace App\Food;

use App\Proxy\CookProcessInterface;

class Hotdog extends BaseFood
{
    public function __clone()
    {
        $this->ingredients = ['bun', 'sausage'];
        $this->status = CookProcessInterface::STATUS_RAW;
    }
}
