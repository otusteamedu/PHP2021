<?php

declare(strict_types=1);

namespace App\Factory\Products;

final class HotdogProduct extends Product
{

    private const BASE_ELEMENTS = [
        "Булка для хот-дога",
        "Сосиска",
        "Кетчуп",
        "Майонез",
    ];

    protected function doBaseRecipe()
    {
        echo "готовим хот-дог" . PHP_EOL;
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