<?php 

namespace \App\ActionsForFood;

use \App\Interfaces;

class CoockingFood implements FoodCustumer
{
    protected $foodCustomers = [];

    protected function notify(Food $food)
    {
        foreach ($this->foodCustomers as $foodCustomer) {
            $foodCustomer->OnFoodReady($food);
        }
    }

    public function attach(FoodCustumer $foodCustomer)
    {
        $this->foodCustomers[] = $foodCustomer;
    }

    public function addJob(Food $food)
    {
        $this->notify($food);
    }
}