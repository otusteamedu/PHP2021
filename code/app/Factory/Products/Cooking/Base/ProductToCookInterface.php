<?php

namespace App\Factory\Products\Cooking\Base;

use App\Factory\Products\ProductInterface;

interface ProductToCookInterface extends ProductInterface
{

    /**
     * @return bool
     */
    public function create(): bool;

    /**
     * @return string
     */
    public function getStatus(): string;

}