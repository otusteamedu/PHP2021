<?php

namespace App;

use App\Decorator\BurgerIngredientMixer;
use App\Decorator\CustomerIngredientMixer;
use App\Decorator\HotdogIngredientMixer;
use App\Decorator\IngredientMixerInterface;
use App\Decorator\SandwichIngredientMixer;
use App\Factory\FoodFactory;
use App\Food\Burger;
use App\Food\Hotdog;
use App\Food\Sandwich;
use App\Observer\Cook;
use App\Observer\CookObservation;
use App\Observer\Customer;
use App\Proxy\CookProcess;
use DI\Container;
use DI\ContainerBuilder;
use Exception;

class App
{
    private Container $container;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->container =(new ContainerBuilder())->build();
    }

    /**
     * @throws Exception
     */
    public function run(): void
    {
        $cook = $this->container->get(Cook::class);
        $customer = $this->container->get(Customer::class);
        $cookObservation = $this->container->get(CookObservation::class);
        $cookObservation->attach($cook);
        $cookObservation->attach($customer);

        $food = FoodFactory::get($_POST['food_type'] ?? '')->makeFood();
        $this->prepare($food);
        printf('Food ingredients are %s.<br/>', $food->getIngredientsList());

        $process = new CookProcess($food, $cookObservation);
        $process->cook();

        $cookObservation->detach($cook);
        $cookObservation->detach($customer);
    }

    private function prepare(IngredientMixerInterface $food): void {
        $mixer = $food;
        switch (get_class($food)) {
            case Burger::class:
                $mixer = new BurgerIngredientMixer($mixer);
                break;
            case Hotdog::class:
                $mixer = new HotdogIngredientMixer($mixer);
                break;
            case Sandwich::class:
                $mixer = new SandwichIngredientMixer($mixer);
                break;
        }
        $mixer = new CustomerIngredientMixer($mixer);
        $mixer->addIngredients($_POST['ingredients'] ?? []);
    }
}
