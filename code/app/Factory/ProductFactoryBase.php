<?php

declare(strict_types=1);

namespace App\Factory;

use App\Factory\Products\Cooking\Base\ProductToCookInterface;
use App\Factory\Products\Cooking\ProductWithElement;
use App\Factory\Products\Cooking\ProductWithElementChecked;
use App\Factory\Products\Element;
use App\Factory\Products\EmptyProduct;
use App\Factory\Products\ProductInterface;
use SplObserver;

abstract class ProductFactoryBase implements ProductFactoryInterface
{

    /**
     * @param ProductInterface $product
     * @param array $elements
     * @param SplObserver|null $observer
     * @return ProductToCookInterface
     */
    protected function createProductBase(
        ProductInterface $product,
        array            $elements,
        SplObserver      $observer = null,
        bool             $isCustom = false
    ): ProductToCookInterface
    {

        $finalElements = $this->getElements($product, $elements, $isCustom);

        $productToBuild = new EmptyProduct($product);

        foreach ($finalElements as $element) {
            $productToBuild = new ProductWithElement($productToBuild, new Element($element));
        }

        $finalProduct = new ProductWithElementChecked($productToBuild);

        if (!is_null($observer)) {
            $finalProduct->attach($observer);
        }

        return $finalProduct;
    }

    /**
     * @param ProductInterface $product
     * @param array $elements
     * @param bool $isCustom
     * @return array
     */
    private function getElements(ProductInterface $product, array $elements, bool $isCustom = false): array
    {
        if (!$isCustom) {
            $elements = array_merge($product->getElements(), $elements);
        }

        return $elements;
    }

}