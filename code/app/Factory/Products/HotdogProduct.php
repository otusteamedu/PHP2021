<?php

declare(strict_types=1);

namespace App\Factory\Products;

final class HotdogProduct extends Product
{

    protected function doBaseRecipe()
    {
        echo "готовим хот-дог" . PHP_EOL;
    }
}