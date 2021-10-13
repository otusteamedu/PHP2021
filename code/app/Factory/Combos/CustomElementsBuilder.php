<?php

declare(strict_types=1);

namespace App\Factory\Combos;

use App\Factory\ProductFactoryInterface;
use App\Factory\Products\Cooking\Base\ProductToCookInterface;
use SplObserver;

final class CustomElementsBuilder implements ProductBuildInterface
{

    private const CUSTOM_ELEMENTS = [
        "лук",
        "острый соус",
        "куриная котлета",
        "сыр",
    ];

    public function build(): ProductToCookInterface
    {

        while (true) {
            $randomElement = self::CUSTOM_ELEMENTS[rand(0, count(self::CUSTOM_ELEMENTS) - 1)];

            $burger = $this->factory->createProduct("с доп. ингридиентами", [$randomElement], $this->observer);
            if ($burger->create()) {
                return $burger;
            }
        }

    }

    public function __construct(private ProductFactoryInterface $factory, private SplObserver $observer)
    {
    }

}