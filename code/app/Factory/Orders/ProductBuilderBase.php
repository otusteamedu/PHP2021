<?php

declare(strict_types=1);

namespace App\Factory\Orders;

use App\Factory\ProductFactoryInterface;
use App\Factory\Products\Cooking\Base\ProductToCookInterface;
use LogicException;
use SplObserver;

abstract class ProductBuilderBase implements ProductBuildInterface
{

    /**
     * @param ProductToCookInterface $product
     * @return ProductToCookInterface|null
     */
    protected function tryToCreateProduct(ProductToCookInterface $product): ?ProductToCookInterface
    {
        try {
            if ($product->create()) {
                return $product;
            }
        } catch (LogicException $e) {
            echo $e->getMessage() . PHP_EOL;
        }
        return null;
    }

    abstract public function __construct(ProductFactoryInterface $factory, SplObserver $observer);

    abstract public function build(): ?ProductToCookInterface;
}