<?php

declare(strict_types=1);

namespace App\Factory;

use App\Factory\Products\Cooking\Base\ProductToCookInterface;
use App\Factory\Products\HotdogProduct;
use SplObserver;

final class HotdogFactory extends ProductFactoryBase
{

    private const PRODUCT_NAME = 'Хот-дог ';

    private const ELEMENTS = [
        "Булка для хот-дога",
        "Сосиска",
        "Кетчуп",
        "Майонез",
    ];

    public function __construct()
    {
        $this->baseElements = self::ELEMENTS;
    }

    public function createProduct(
        string      $name,
        array       $customElements = [],
        SplObserver $observer = null
    ): ProductToCookInterface
    {
        $hotdog = new HotdogProduct(self::PRODUCT_NAME . $name);

        return $this->createProductBase($hotdog, $customElements, $observer);
    }

}