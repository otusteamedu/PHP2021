<?php

declare(strict_types=1);

namespace App\Factory;

use App\Factory\Products\Cooking\Base\ProductToCookInterface;
use App\Factory\Products\SandwichProduct;
use SplObserver;

final class SandwichFactory extends ProductFactoryBase
{

    private const PRODUCT_NAME = 'Сэндвич ';

    private const ELEMENTS = [
        "Тосты для сендвича",
        "Ветчина",
        "Сыр",
        "Майонез",
    ];

    public function __construct()
    {
        $this->baseElements = self::ELEMENTS;
    }

    /**
     * @param string $name
     * @param array $customElements
     * @param SplObserver|null $observer
     * @return ProductToCookInterface
     */
    public function createProduct(
        string      $name,
        array       $customElements = [],
        SplObserver $observer = null
    ): ProductToCookInterface
    {
        $sandwich = new SandwichProduct(self::PRODUCT_NAME . $name);

        return $this->createProductBase($sandwich, $customElements, $observer);
    }

}