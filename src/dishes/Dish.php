<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.03.2022
 * Time: 15:32
 */

namespace app\dishes;


/**
 * Блюдо
 *
 * Class Dish
 * @package app\dishes
 */
class Dish implements DishIngredientsInterface
{
    /**
     * Рецепт
     *
     * @var DishIngredientsInterface
     */
    private DishIngredientsInterface $ingredients;

    /**
     * @param DishIngredientsInterface $ingredients
     */
    public function __construct(DishIngredientsInterface $ingredients)
    {
        $this->ingredients = $ingredients;
    }

    /**
     * @inheritDoc
     */
    public function getIngredients(): array
    {
        $ingredients = $this->ingredients;

        return $ingredients->getIngredients();
    }
}
