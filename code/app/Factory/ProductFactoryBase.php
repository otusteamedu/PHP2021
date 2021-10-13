<?php

declare(strict_types=1);

namespace App\Factory;

use App\Factory\Products\Cooking\Base\ProductToCookInterface;
use App\Factory\Products\Cooking\ProductWithElement;
use App\Factory\Products\Cooking\ProductWithElementChecked;
use App\Factory\Products\Element;
use App\Factory\Products\ProductInterface;
use SplObserver;

abstract class ProductFactoryBase implements ProductFactoryInterface
{

    protected array $baseElements;

    protected function createProductBase(
        ProductInterface $product,
        array            $elements,
        SplObserver      $observer = null
    ): ProductToCookInterface
    {
        $elements = array_merge($this->baseElements, $elements);

        foreach ($elements as $element) {
            $product = new ProductWithElement($product, new Element($element));
        }

        $finalProduct = new ProductWithElementChecked($product);

        if (!is_null($observer)) {
            $finalProduct->attach($observer);
        }

        return $finalProduct;
    }

}