<?php

namespace App;

use App\Observer\Customer;
use App\Strategy\BurgerStrategy;
use App\Strategy\HotDogStrategy;
use App\Strategy\OrderContext;
use App\Strategy\SandwichStrategy;
use Exception;

class Application
{
    private $request;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        try {
            $this->request = RequestValidator::validate($_POST);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        $customer = new Customer();
        $order = new OrderContext($customer);

        switch ($_POST['meal']) {
            case 'Burger':
                $order->setCookingStrategy(new BurgerStrategy());
                break;
            case 'HotDog':
                $order->setCookingStrategy(new HotDogStrategy());
                break;
            case 'Sandwich':
                $order->setCookingStrategy(new SandwichStrategy());
                break;
            default:
                throw new Exception('No meal choosed');
        }

        $meal = $order->getOrderedMeal($_POST['client_ingredients'] ?? []);
        print_r($meal->getIngredients());
    }
}