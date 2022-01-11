<?php

namespace App\Domain;

use App\Domain\Models\Burger;
use App\Domain\Models\HotDog;
use App\Domain\Models\Sandwich;

interface VisitorInterface
{
    public function visitHotDog(HotDog $hotDog) :void;

    public function visitBurger(Burger $burger) :void;

    public function visitSandwich(Sandwich $sandwich) :void;
}