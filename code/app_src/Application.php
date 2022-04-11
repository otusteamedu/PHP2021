<?php

namespace App;

class Application
{
    private $request;

    public function __construct()
    {
		try {
			$this->request = RequestValidator::validate($_POST);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}
    }

    public function run(): void
	{
		$customer = new Observer\Customer();
		$order = new Strategy\OrderContext($customer);

		switch ($_POST['meal']) {
			case 'Burger':
				$order->setCookingStrategy(new Strategy\BurgerStrategy());
				break;
			
			case 'Hotdog':
				$order->setCookingStrategy(new Strategy\HotdogStrategy());
				break;
			
			case 'Sandwich':
				$order->setCookingStrategy(new Strategy\SandwichStrategy());
				break;
			
			default:
				throw new Exception('No meal choosed');
		}

		$meal = $order->getOrderedMeal(isset($_POST['client_ingredients']) ? $_POST['client_ingredients'] : []);
		print_r($meal->getIngredients());
    }
}
