<?php

namespace App\Factory\Combos;

use App\Factory\ProductFactoryInterface;
use App\Factory\Products\Cooking\Base\ProductToCookInterface;
use SplObserver;

interface ProductBuildInterface
{

    public function __construct(ProductFactoryInterface $factory, SplObserver $observer);

    public function build(): ProductToCookInterface;

}