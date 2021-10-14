<?php

declare(strict_types=1);

namespace App\Factory;

use App\Factory\Products\Cooking\Base\ProductToCookInterface;
use App\Factory\Products\SandwichProduct;
use SplObserver;

final class SandwichFactory extends ProductFactoryBase
{

    private const PRODUCT_NAME = 'Сэндвич ';

    /**
     * @param string $name
     * @param array $customElements
     * @param SplObserver|null $observer
     * @return ProductToCookInterface
     */
    public function createProduct(
        string      $name,
        array       $customElements = [],
        SplObserver $observer = null,
        bool        $isCustom = false
    ): ProductToCookInterface
    {
        $sandwich = new SandwichProduct(self::PRODUCT_NAME . $name);

        return $this->createProductBase($sandwich, $customElements, $observer, $isCustom);
    }

}