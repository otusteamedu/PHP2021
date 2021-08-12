<?php

namespace \App\Clients;

use \App\Interfaces;

class Coocker {

    protected $coocker;

    public function __construct(Strategy $coocker){
        $this->coocker = $coocker;
    }

    public function coock(Food $food){
        return $this->coocker->coock($food);
    }

}