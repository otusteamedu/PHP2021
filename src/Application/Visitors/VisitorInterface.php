<?php

namespace App\Application\Visitors;

use App\Domain\Models\Burger;
use App\Domain\Models\HotDog;
use App\Domain\Models\Sandwich;

interface VisitorInterface
{
    public function visitHotDog(HotDog $hotDog);

    public function visitBurger(Burger $burger);

    public function visitSandwich(Sandwich $sandwich);
}