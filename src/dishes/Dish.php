<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 10.03.2022
 * Time: 17:43
 */

namespace app\dishes;


/**
 * Блюдо
 *
 * Class AdditionIngredient
 * @package app\dishes
 */
class Dish implements DishIngredientsInterface
{
    /**
     * Ингредиенты блюда
     *
     * @var DishIngredientsInterface
     */
    private DishIngredientsInterface $dish;

    /**
     * @param DishIngredientsInterface $dish
     */
    private function __construct(DishIngredientsInterface $dish)
    {
        $this->dish = $dish;
    }

    /**
     * Добавить ингредиент к блюду
     *
     * @param DishIngredientsInterface $dish
     * @return static
     */
    public static function addToDish(DishIngredientsInterface $dish): self
    {
        return new static($dish);
    }

    /**
     * @inheritDoc
     */
    public function getIngredients(): array
    {
        return $this
            ->dish
            ->getIngredients();
    }
}
