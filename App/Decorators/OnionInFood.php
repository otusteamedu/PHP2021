<?php

namespace Decorators;

use \App\Interfaces;

class OnionInFood implements Food{

    private $food;

    public function __construct(Food $food){
        $this->food = $food;
    }

    public function getCoast(){
        return $this->food->getCoast() + 10;
    }

    public function getDescription(){
        return $this->food->getDescription() . 'с луком';
    }
    
}