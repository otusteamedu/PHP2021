<?php

declare(strict_types=1);

namespace App\Factory\Combos;

use App\Factory\ProductFactoryInterface;
use App\Factory\Products\Cooking\Base\ProductToCookInterface;
use SplObserver;

final class SimpleBuilder implements ProductBuildInterface
{

    public function build(): ProductToCookInterface
    {

        while (true) {
            $burger = $this->factory->createProduct("чизбургер ", ["сыр"], $this->observer);
            if ($burger->create()) {
                return $burger;
            }
        }

    }

    public function __construct(private ProductFactoryInterface $factory, private SplObserver $observer)
    {
    }

}