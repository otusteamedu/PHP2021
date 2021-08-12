<?php 

namespace App\FoodCustomers;

use App\Interfaces;

class FoodCustomer implements FoodCustumer{

    private $name;

    public function __construct(string $name){

        $this->name = $name;

    }

    public function OnFoodReady(Food $food){
        echo "Привет {$this->name}, ваш {$food} готов!";
    }

}