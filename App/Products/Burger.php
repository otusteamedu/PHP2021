<?php

namespace App\Products;

use App\Interfaces\Food;

class Burger implements Food{
    
    public function getCoast(){
        return 200;
    }

    public function getDescription(){
        return "Бургер";
    }

    public function getTitle(){
        return "Биг тэйсти";
    }
}