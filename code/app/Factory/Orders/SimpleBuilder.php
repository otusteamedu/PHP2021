<?php

declare(strict_types=1);

namespace App\Factory\Orders;

use App\Factory\ProductFactoryInterface;
use App\Factory\Products\Cooking\Base\ProductToCookInterface;
use SplObserver;

final class SimpleBuilder implements ProductBuildInterface
{

    /**
     * @return ProductToCookInterface
     */
    public function build(): ProductToCookInterface
    {

        while (true) {
            $burger = $this->factory->createProduct("чизбургер ", ["сыр"], $this->observer);
            if ($burger->create()) {
                return $burger;
            }
        }

    }

    /**
     * @param ProductFactoryInterface $factory
     * @param SplObserver $observer
     */
    public function __construct(private ProductFactoryInterface $factory, private SplObserver $observer)
    {
    }

}