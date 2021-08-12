<?php

namespace App\Products;

use App\Interfaces\Food;

class Sendwich implements Food{

    public function getCoast(){
        return 300;
    }

    public function getDescription(){
        return "Сендвич";
    }

    public function getTitle(){
        return "Классический";
    }
}