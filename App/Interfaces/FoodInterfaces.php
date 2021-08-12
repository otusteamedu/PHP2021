<?php

namespace App\Interfaces;

interface Food{

    public function getCoast();
    public function getDescription();
    public function getTitle();
}

interface FoodFactory{
    public function makeFood() : Food;
}

interface FoodCustumer {
    public function OnFoodReady();
}

interface Observable {
    public function notify() : Food;
    public function attach() : FoodCustumer;
    public function addFood() : Food;
}

interface Strategy {

    public function coock();

}