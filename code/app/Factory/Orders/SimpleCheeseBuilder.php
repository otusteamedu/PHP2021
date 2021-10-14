<?php

declare(strict_types=1);

namespace App\Factory\Orders;

use App\Factory\ProductFactoryInterface;
use App\Factory\Products\Cooking\Base\ProductToCookInterface;
use SplObserver;

final class SimpleCheeseBuilder extends ProductBuilderBase
{

    private const NAME = "с сыром";

    private const ELEMENTS = ["сыр"];

    /**
     * @return ProductToCookInterface|null
     */
    public function build(): ?ProductToCookInterface
    {

        $burger = $this->factory->createProduct(self::NAME, self::ELEMENTS, $this->observer);
        return $this->tryToCreateProduct($burger);

    }

    /**
     * @param ProductFactoryInterface $factory
     * @param SplObserver $observer
     */
    public function __construct(private ProductFactoryInterface $factory, private SplObserver $observer)
    {
    }

}