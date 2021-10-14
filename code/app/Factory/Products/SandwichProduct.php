<?php

declare(strict_types=1);

namespace App\Factory\Products;

final class SandwichProduct extends Product
{

    protected function doBaseRecipe()
    {
        echo "готовим сэндвич" . PHP_EOL;
    }

}
