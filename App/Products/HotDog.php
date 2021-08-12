<?php

namespace App\Products;

use App\Interfaces\Food;

class HotDog implements Food{

    public function getCoast(){
        return 250;
    }

    public function getDescription(){
        return "Хот дог";
    }

    public function getTitle(){
        return "Корн дог";
    }
}