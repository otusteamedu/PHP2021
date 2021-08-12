<?php

namespace App\Factories;

use App\Interfaces\FoodFactory;
use App\Products\HotDog;

class HotDogFactory implements FoodFactory{

    public function makeFood() : Food {
        return new HotDog();
    }

}