<?php

declare(strict_types=1);

namespace App\Factory;

use App\Factory\Products\Cooking\Base\ProductToCookInterface;
use App\Factory\Products\HotdogProduct;
use SplObserver;

final class HotdogFactory extends ProductFactoryBase
{

    private const PRODUCT_NAME = 'Хот-дог ';

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
        $hotdog = new HotdogProduct(self::PRODUCT_NAME . $name);

        return $this->createProductBase($hotdog, $customElements, $observer, $isCustom);
    }

}