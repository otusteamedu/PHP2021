<?php

namespace App\Factories;

use App\Interfaces\FoodFactory;
use App\Products\Sendwich;

class SendwichFactory implements FoodFactory{

    public function makeFood() : Food {
        return new Sendwich();
    }

}