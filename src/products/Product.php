<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 10.03.2022
 * Time: 17:21
 */

namespace app\products;


use app\dishes\DishIngredientsInterface;

/**
 * Базовый продукт
 *
 * Class Product
 * @package app\products
 */
class Product implements DishIngredientsInterface
{
    /**
     * Название продукта
     *
     * @var string
     */
    private string $title;

    /**
     * @param string $title
     */
    public function __construct(string $title)
    {
        $this->title = $title;
    }

    /**
     * @inheritDoc
     */
    public function getIngredients(): array
    {
        return [];
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}
