<?php

declare(strict_types=1);

namespace App\Factory;

use App\Factory\Products\BurgerProduct;
use App\Factory\Products\Cooking\Base\ProductToCookInterface;
use SplObserver;

final class BurgerFactory extends ProductFactoryBase
{

    private const PRODUCT_NAME = 'Бугрер ';

    private const ELEMENTS = [
        "Булка для бургера",
        "Котлета",
        "Кетчуп",
        "Маринованый огурец",
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
        $burger = new BurgerProduct(self::PRODUCT_NAME . $name);

        return $this->createProductBase($burger, $customElements, $observer);
    }
}