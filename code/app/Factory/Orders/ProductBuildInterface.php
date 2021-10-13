<?php

namespace App\Factory\Orders;

use App\Factory\ProductFactoryInterface;
use App\Factory\Products\Cooking\Base\ProductToCookInterface;
use SplObserver;

interface ProductBuildInterface
{

    /**
     * @param ProductFactoryInterface $factory
     * @param SplObserver $observer
     */
    public function __construct(ProductFactoryInterface $factory, SplObserver $observer);

    /**
     * @return ProductToCookInterface
     */
    public function build(): ProductToCookInterface;

}