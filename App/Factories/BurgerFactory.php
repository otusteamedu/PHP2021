<?php

namespace App\Factories;

use App\Interfaces\FoodFactory;
use App\Products\Burger;

class BurgerFactory implements FoodFactory{

    public function makeFood() : Food {
        return new Burger();
    }

}