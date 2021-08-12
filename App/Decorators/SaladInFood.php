<?php

namespace Decorators;

use \App\Interfaces;

class SaladInFood implements Food{

    private $food;

    public function __construct(Food $food){
        $this->food = $food;
    }

    public function getCoast(){
        return $this->food->getCoast() + 25;
    }

    public function getDescription(){
        return $this->food->getDescription() . 'с салатом';
    }

}