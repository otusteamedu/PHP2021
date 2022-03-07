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
use App\Food\Ingredient;
use App\Food\Sandwich;
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
        $this->container =
            (new ContainerBuilder())->addDefinitions('config/config.php')
                                    ->build();
    }

    /**
     * @throws Exception
     */
    public function run(): void
    {
        $food = FoodFactory::get($_POST['food_type'] ?? '')->makeFood();
        $this->prepareFood($food);
        printf('Food ingredients are %s.<br/>', $food->getIngredientsList());

        $process = $this->container->get(CookProcess::class);
        $process->cookFood($food);
    }

    /**
     * @throws Exception
     */
    private function prepareFood(IngredientMixerInterface $food): void
    {
        $mixer = $food;
        switch (get_class($food)) {
            case Burger::class:
                $mixer = BurgerIngredientMixer::get($mixer);
                break;
            case Hotdog::class:
                $mixer = HotdogIngredientMixer::get($mixer);
                break;
            case Sandwich::class:
                $mixer = SandwichIngredientMixer::get($mixer);
                break;
        }
        $mixer = CustomerIngredientMixer::get($mixer);
        $mixer->addIngredients($this->getIngredients());
    }

    private function getIngredients(): array
    {
        $ingredients = [];
        foreach ($_POST['ingredients'] ?? [] as $key => $value) {
            $ingredients[] = new Ingredient($key, $value);
        }

        return $ingredients;
    }
}
