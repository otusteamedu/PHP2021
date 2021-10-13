<?php

declare(strict_types=1);

namespace App\Factory;

use App\Factory\Products\Cooking\Base\ProductToCookInterface;
use SplObserver;

interface ProductFactoryInterface
{

    /**
     * @param string $name
     * @param array $customElements
     * @param SplObserver $observer
     * @return ProductToCookInterface
     */
    public function createProduct(string $name, array $customElements, SplObserver $observer): ProductToCookInterface;

}