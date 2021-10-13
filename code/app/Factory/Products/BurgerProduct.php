<?php

declare(strict_types=1);

namespace App\Factory\Products;

final class BurgerProduct extends Product
{

    protected function doBaseRecipe()
    {
        echo "готовим бургер" . PHP_EOL;
    }
}