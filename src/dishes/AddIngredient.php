<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.03.2022
 * Time: 17:31
 */

namespace app\dishes;

use app\ingredients\IngredientInterface;

/**
 * Добавление ингредиента
 *
 * Class AddIngredient
 * @package app\dishes
 */
class AddIngredient extends Dish
{
    /**
     * Ингредиент для добавления
     *
     * @var IngredientInterface
     */
    private IngredientInterface $addIngredient;

    /**
     * @param DishIngredientsInterface $dishIngredients
     * @param IngredientInterface $addIngredient
     */
    public function __construct(
        DishIngredientsInterface $dishIngredients,
        IngredientInterface      $addIngredient
    )
    {
        parent::__construct($dishIngredients);

        $this->addIngredient = $addIngredient;
    }

    /**
     * @inheritDoc
     */
    public function getIngredients(): array
    {
        $addIngredient = $this->addIngredient;

        return array_merge(
            parent::getIngredients(),
            [
                $addIngredient,
            ]
        );
    }
}
