<?php

declare(strict_types=1);

namespace App\Factory\Orders;

use App\Factory\ProductFactoryInterface;
use App\Factory\Products\Cooking\Base\ProductToCookInterface;
use LogicException;
use SplObserver;

final class CustomElementsBuilder extends ProductBuilderBase
{

    /**
     * @return ProductToCookInterface|null
     */
    public function build(): ?ProductToCookInterface
    {

        $burger = $this->factory->createProduct("(оригинальный рецепт)", $this->elements, $this->observer, true);
        return $this->tryToCreateProduct($burger);

    }

    /**
     * @param ProductFactoryInterface $factory
     * @param SplObserver $observer
     * @param array $elements
     */
    public function __construct(
        private ProductFactoryInterface $factory,
        private SplObserver             $observer,
        private array                   $elements = []
    )
    {
    }

}