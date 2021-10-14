<?php

declare(strict_types=1);

namespace App\Factory\Products;

final class BurgerProduct extends Product
{

    private const BASE_ELEMENTS = [
        "Булка для бургера",
        "Котлета",
        "Кетчуп",
        "Маринованый огурец",
    ];

    protected function doBaseRecipe()
    {
        echo "готовим бургер" . PHP_EOL;
    }

    /**
     * @return array
     */
    public function getElements(): array
    {
        return array_merge(
            parent::getElements(),
            self::BASE_ELEMENTS,
        );
    }

}