<?php

namespace \App\Strategies;

use \App\Interfaces;

class CoockStrategy implements Strategy {

    protected $food;

    public function __construct(Food $food){
        $this->food = $food;
    }

    public function coock(Food $food){

        echo "Готовим {$food->getTitle()}";

    }

}