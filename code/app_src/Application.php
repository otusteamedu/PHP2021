<?php

namespace App;

use App\Observer\Customer;
use App\Strategy\BurgerStrategy;
use App\Strategy\HotdogStrategy;
use App\Strategy\OrderContext;
use App\Strategy\SandwichStrategy;

class Application
{
    private $request;

    public function __construct($local)
    {
        $GLOBALS['local'] = $local;
        $this->request = $_POST;
    }

    /** @throws \Exception */
    public function run(): array
    {
        $customer = new Customer($_POST['email']);
        $order = new OrderContext($customer);

        switch ($_POST['meal']) {
            case 'Burger':
                $order->setCookingStrategy(new BurgerStrategy());

                break;

            case 'Hotdog':
                $order->setCookingStrategy(new HotdogStrategy());

                break;

            case 'Sandwich':
                $order->setCookingStrategy(new SandwichStrategy());

                break;

            default:
                throw new \Exception('Блюдо не выбрано');
        }

        $meal = $order->getOrderedMeal(isset($_POST['client_ingredients']) ? $_POST['client_ingredients'] : []);

        return $meal->getIngredients();
    }
}
