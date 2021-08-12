<?php

namespace Decorators;

use \App\Interfaces;

class PepperInFood implements Food{

    private $food;

    public function __construct(Food $food){
        $this->food = $food;
    }

    public function getCoast(){
        return $this->food->getCoast() + 50;
    }

    public function getDescription(){
        return $this->food->getDescription() . 'с перцем';
    }
    
}